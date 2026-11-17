<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\ChallengeAttempt;
use App\Models\Enrollment;
use App\Models\LessonProgress;
use App\Services\ChallengeGrader;
use App\Services\GamificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ChallengeAttemptController extends Controller
{
    public function store(
        Request $request,
        Challenge $challenge,
        ChallengeGrader $grader,
        GamificationService $gamification,
    ): RedirectResponse
    {
        Gate::authorize('view', $challenge->lesson);
        abort_unless($request->user()->isChild(), 403);

        $response = $this->validatedResponse($request, $challenge);
        $child = $request->user()->childProfile;
        abort_unless($child, 403);

        $result = DB::transaction(function () use ($child, $challenge, $response, $grader, $gamification) {
            $enrollment = Enrollment::query()
                ->where('child_id', $child->id)
                ->lockForUpdate()
                ->firstOrFail();

            $challengeVersionId = $challenge->lesson->level->path_version_id;
            abort_unless(
                $challengeVersionId === $enrollment->path_version_id
                    && $challenge->lesson->level->pathVersion->status === 'published'
                    && $challenge->lesson->level->pathVersion->pathway->age_group === $child->age_group,
                403,
            );

            $existingAttempt = ChallengeAttempt::query()
                ->where('enrollment_id', $enrollment->id)
                ->where('challenge_id', $challenge->id)
                ->where('request_key', $response['request_key'])
                ->first();

            if ($existingAttempt) {
                abort_unless(
                    $this->normalize($existingAttempt->response) === $this->normalize($response['answer']),
                    409,
                    'مفتاح الطلب مستخدم مع إجابة مختلفة.',
                );

                return [
                    'is_correct' => $existingAttempt->is_correct,
                    'stars' => $existingAttempt->stars,
                    'replayed' => true,
                ];
            }

            $isCorrect = $grader->grade($challenge, $response['answer']);
            $attempt = ChallengeAttempt::create([
                'enrollment_id' => $enrollment->id,
                'challenge_id' => $challenge->id,
                'request_key' => $response['request_key'],
                'response' => $response['answer'],
                'is_correct' => $isCorrect,
                'stars' => $isCorrect ? 3 : 0,
            ]);

            $progress = LessonProgress::firstOrCreate(
                ['enrollment_id' => $enrollment->id, 'lesson_id' => $challenge->lesson_id],
                ['xp_awarded' => false],
            );
            $progress->activity_tried_at = now();

            if ($isCorrect) {
                $gamification->completeLesson($enrollment, $challenge->lesson);
            }

            $progress->save();
            $gamification->awardChallengeStars($enrollment, $challenge, $attempt);
            $enrollment->last_activity_at = now();
            $enrollment->save();

            return [
                'is_correct' => $attempt->is_correct,
                'stars' => $attempt->stars,
                'replayed' => false,
            ];
        });

        return redirect()
            ->route('learn.lessons.show', $challenge->lesson_id)
            ->with('challenge_result', $result);
    }

    private function validatedResponse(Request $request, Challenge $challenge): array
    {
        $rules = [
            'request_key' => ['required', 'string', 'max:100'],
        ];

        if ($challenge->kind === 'ordering') {
            $stepIds = collect($challenge->config['steps'] ?? [])->pluck('id')->all();
            $rules['order'] = ['required', 'array', 'size:'.count($stepIds)];
            $rules['order.*'] = ['required', 'string', Rule::in($stepIds)];
        } elseif ($challenge->kind === 'maze') {
            $maxSteps = min(100, max(1, (int) ($challenge->grading_key['max_steps'] ?? 0)));
            $input = $request->all();
            if (is_array($input['commands'] ?? null)) {
                $input['commands'] = array_values(array_filter(
                    $input['commands'],
                    fn ($command) => $command !== null && $command !== '',
                ));
            }
            $request->replace($input);
            $rules['commands'] = ['required', 'array', 'min:1', 'max:'.$maxSteps];
            $rules['commands.*'] = ['required', 'string', Rule::in($challenge->config['commands'] ?? [])];
        } elseif ($challenge->kind === 'predict') {
            $optionIds = collect($challenge->config['options'] ?? [])->pluck('id')->all();
            $rules['option_id'] = ['required', 'string', Rule::in($optionIds)];
        } elseif ($challenge->kind === 'fix') {
            $lineIds = collect($challenge->config['lines'] ?? [])->pluck('id')->all();
            $replacementIds = collect($challenge->config['replacements'] ?? [])->pluck('id')->all();
            $rules['line_id'] = ['required', 'string', Rule::in($lineIds)];
            $rules['replacement_id'] = ['required', 'string', Rule::in($replacementIds)];
        } else {
            abort(404);
        }

        $validated = Validator::make($request->all(), $rules)->validate();
        $requestKey = $validated['request_key'];
        unset($validated['request_key']);

        return [
            'request_key' => $requestKey,
            'answer' => $validated,
        ];
    }

    private function normalize(array $value): array
    {
        foreach ($value as &$item) {
            if (is_array($item)) {
                $item = $this->normalize($item);
            }
        }
        unset($item);

        if (! array_is_list($value)) {
            ksort($value);
        }

        return $value;
    }

}
