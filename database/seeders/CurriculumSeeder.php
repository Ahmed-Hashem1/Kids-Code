<?php

namespace Database\Seeders;

use App\Models\Assessment;
use App\Models\Challenge;
use App\Models\Child;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\LessonMedia;
use App\Models\Level;
use App\Models\Option;
use App\Models\PathVersion;
use App\Models\Pathway;
use App\Models\Question;
use Illuminate\Database\Seeder;

class CurriculumSeeder extends Seeder
{
    public function run(): void
    {
        $pathways = [
            ['7-9', 'مغامرات البرمجة للصغار', 'masar-7-9'],
            ['10-12', 'مسار البرمجة للمبدعين', 'masar-10-12'],
            ['13-15', 'مسار البرمجة المتقدم', 'masar-13-15'],
        ];

        foreach ($pathways as [$ageGroup, $title, $slug]) {
            Pathway::updateOrCreate(
                ['age_group' => $ageGroup],
                ['title' => $title, 'slug' => $slug],
            );
        }

        $pathway = Pathway::where('age_group', '10-12')->firstOrFail();
        $pathVersion = PathVersion::updateOrCreate(
            ['pathway_id' => $pathway->id, 'version_no' => 1],
            [
                'status' => 'published',
                'published_at' => now(),
            ],
        );

        $child = Child::whereHas('user', fn ($query) => $query->where('username', 'hero10'))->first();
        if ($child) {
            Enrollment::updateOrCreate(
                ['child_id' => $child->id],
                [
                    'path_version_id' => $pathVersion->id,
                    'start_level_id' => null,
                    'xp_total' => 0,
                ],
            );
        }

        $levelDefinitions = [
            [
                'title' => 'print والمتغيرات',
                'lessons' => [
                    ['عرض أول رسالة', 'نتعلم كيف نعرض الكلمات على الشاشة باستخدام الأمر print.'],
                    ['الأرقام والعمليات', 'نجرب العمليات الحسابية البسيطة ونعرض ناتجها باستخدام print.'],
                    ['التعرف على المتغيرات', 'نخزن قيمة في متغير ثم نستخدمها في برنامجنا.'],
                ],
                'challenges' => ['predict', 'ordering', 'fix'],
            ],
            [
                'title' => 'if / else',
                'lessons' => [
                    ['اتخاذ القرار', 'نتعلم كيف يفحص البرنامج شرطاً قبل تنفيذ التعليمات.'],
                    ['مسار if و else', 'نجعل البرنامج يختار بين نتيجتين باستخدام if و else.'],
                    ['مقارنة القيم', 'نقارن بين قيمتين ونستخدم نتيجة المقارنة لاتخاذ قرار.'],
                ],
                'challenges' => ['maze', 'predict', 'ordering'],
            ],
            [
                'title' => 'for / while',
                'lessons' => [
                    ['التكرار باستخدام for', 'نكرر مجموعة من التعليمات عدداً محدداً من المرات.'],
                    ['التكرار باستخدام while', 'نكرر التعليمات ما دام الشرط الذي اخترناه صحيحاً.'],
                    ['اختيار نوع التكرار', 'نختار بين for و while لحل مهمة برمجية صغيرة.'],
                ],
                'challenges' => ['fix', 'maze', 'predict'],
            ],
        ];

        $lessonsByLevel = [];
        foreach ($levelDefinitions as $levelIndex => $definition) {
            $position = $levelIndex + 1;
            $level = Level::updateOrCreate(
                ['path_version_id' => $pathVersion->id, 'position' => $position],
                ['title' => $definition['title']],
            );

            foreach ($definition['lessons'] as $lessonIndex => [$title, $body]) {
                $lessonPosition = $lessonIndex + 1;
                $lesson = Lesson::updateOrCreate(
                    ['level_id' => $level->id, 'position' => $lessonPosition],
                    [
                        'title' => $title,
                        'body' => $body,
                        'code_language' => 'python',
                        'reward_xp' => 10,
                    ],
                );
                $lessonsByLevel[$position][] = $lesson;

                $this->seedMedia($lesson, $position, $lessonPosition, $title);
                $this->seedChallenge(
                    $lesson,
                    $definition['challenges'][$lessonIndex],
                    $position,
                    $lessonPosition,
                );
            }
        }

        $placement = Assessment::firstOrCreate(
            [
                'path_version_id' => $pathVersion->id,
                'level_id' => null,
                'kind' => 'placement',
            ],
            ['pass_percent' => null],
        );

        $placementQuestions = [];
        foreach ($lessonsByLevel as $levelPosition => $lessons) {
            foreach (array_slice($this->questionSet($levelPosition), 0, 3) as $question) {
                $placementQuestions[] = $question;
            }
        }
        $this->seedQuestions($placement, $placementQuestions);

        foreach ($lessonsByLevel as $levelPosition => $lessons) {
            $level = $lessons[0]->level;
            $assessment = Assessment::firstOrCreate(
                [
                    'path_version_id' => $pathVersion->id,
                    'level_id' => $level->id,
                    'kind' => 'level_end',
                ],
                ['pass_percent' => 80],
            );
            $this->seedQuestions($assessment, $this->questionSet($levelPosition));
        }
    }

    private function seedMedia(Lesson $lesson, int $levelPosition, int $lessonPosition, string $title): void
    {
        $mediaItems = [
            ['kind' => 'video', 'duration_seconds' => 60, 'alt_text' => "فيديو تعليمي: {$title}"],
            ['kind' => 'caption', 'duration_seconds' => null, 'alt_text' => "نص الفيديو: {$title}"],
            ['kind' => 'image', 'duration_seconds' => null, 'alt_text' => "صورة توضيحية: {$title}"],
        ];

        foreach ($mediaItems as $index => $media) {
            LessonMedia::updateOrCreate(
                ['lesson_id' => $lesson->id, 'position' => $index + 1],
                [
                    ...$media,
                    'storage_key' => "lessons/{$levelPosition}-{$lessonPosition}/{$media['kind']}",
                ],
            );
        }
    }

    private function seedChallenge(Lesson $lesson, string $kind, int $levelPosition, int $lessonPosition): void
    {
        [$config, $gradingKey] = match ($kind) {
            'ordering' => [
                [
                    'steps' => [
                        ['id' => 's1', 'text' => 'اكتب الأمر print'],
                        ['id' => 's2', 'text' => 'اعرض الرسالة'],
                    ],
                ],
                ['order' => ['s1', 's2']],
            ],
            'maze' => [
                [
                    'grid' => [[0, 0, 0], [0, 1, 0], [0, 0, 0]],
                    'start' => [0, 0],
                    'goal' => [2, 2],
                    'commands' => ['up', 'down', 'left', 'right'],
                ],
                ['max_steps' => 12],
            ],
            'predict' => [
                [
                    'code' => 'print(2 + 3)',
                    'language' => 'python',
                    'options' => [
                        ['id' => 'o1', 'text' => '23'],
                        ['id' => 'o2', 'text' => '5'],
                    ],
                ],
                ['option_id' => 'o2'],
            ],
            'fix' => [
                [
                    'lines' => [['id' => 'l1', 'text' => "pritn('Hello')"]],
                    'replacements' => [
                        ['id' => 'r1', 'text' => "print('Hello')"],
                        ['id' => 'r2', 'text' => "echo 'Hello'"],
                    ],
                ],
                ['line_id' => 'l1', 'replacement_id' => 'r1'],
            ],
        };

        Challenge::updateOrCreate(
            ['lesson_id' => $lesson->id],
            [
                'kind' => $kind,
                'prompt' => "أكمل تحدي الدرس {$levelPosition}-{$lessonPosition}.",
                'hint' => 'فكر في ترتيب التعليمات وجرب الحل خطوة خطوة.',
                'config' => $config,
                'grading_key' => $gradingKey,
            ],
        );
    }

    /**
     * @param  list<array{prompt: string, options: list<string>, correct: int}>  $questions
     */
    private function seedQuestions(Assessment $assessment, array $questions): void
    {
        foreach ($questions as $index => $questionData) {
            $question = Question::updateOrCreate(
                ['assessment_id' => $assessment->id, 'position' => $index + 1],
                ['prompt' => $questionData['prompt']],
            );

            Option::where('question_id', $question->id)->delete();
            foreach ($questionData['options'] as $optionIndex => $label) {
                Option::create([
                    'question_id' => $question->id,
                    'label' => $label,
                    'is_correct' => $optionIndex === $questionData['correct'],
                    'position' => $optionIndex + 1,
                ]);
            }
        }
    }

    /**
     * @return list<array{prompt: string, options: list<string>, correct: int}>
     */
    private function questionSet(int $levelPosition): array
    {
        $sets = [
            1 => [
                ['ما الأمر المستخدم لعرض رسالة في Python؟', ['print()', 'show()', 'write()'], 0],
                ['ما نتيجة print(2 + 3)؟', ['23', '5', '6'], 1],
                ['أي اسم مناسب لمتغير يحفظ العمر؟', ['age', '2age', 'age!'], 0],
                ['كيف نضع النص داخل print؟', ["print('مرحبا')", 'print مرحبا', 'say(مرحبا)'], 0],
                ['ما قيمة المتغير بعد x = 4؟', ['4', 'x', '0'], 0],
            ],
            2 => [
                ['ما الكلمة التي تبدأ الشرط في Python؟', ['if', 'when', 'check'], 0],
                ['متى ينفذ فرع else؟', ['عندما لا يتحقق الشرط', 'قبل فحص الشرط', 'دائماً مرتين'], 0],
                ['أي عامل يعني أكبر من؟', ['>', '=', '=='], 0],
                ['ماذا يفعل الشرط if x == 3؟', ['يفحص هل x تساوي 3', 'يغير x إلى 3', 'يطبع x'], 0],
                ['ما فائدة else؟', ['تحديد مسار بديل', 'إنشاء متغير', 'إيقاف البرنامج دائماً'], 0],
            ],
            3 => [
                ['أي حلقة تناسب تكراراً بعدد معروف؟', ['for', 'if', 'else'], 0],
                ['متى تستمر حلقة while؟', ['ما دام الشرط صحيحاً', 'مرة واحدة فقط دائماً', 'عندما يكون الشرط خاطئاً'], 0],
                ['أي كلمة تبدأ حلقة for؟', ['for', 'repeat', 'loop'], 0],
                ['ما الذي يجب الانتباه له في while؟', ['تحديث الشرط لتجنب تكرار لا ينتهي', 'حذف جميع المتغيرات', 'استخدام print فقط'], 0],
                ['ما وظيفة الحلقة؟', ['تكرار التعليمات', 'تعريف مسار ملف', 'مقارنة نصين فقط'], 0],
            ],
        ];

        return array_map(
            fn (array $item): array => ['prompt' => $item[0], 'options' => $item[1], 'correct' => $item[2]],
            $sets[$levelPosition],
        );
    }
}
