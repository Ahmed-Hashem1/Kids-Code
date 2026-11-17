<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class LessonController extends Controller
{
    public function show(Lesson $lesson): View
    {
        Gate::authorize('view', $lesson);

        return view('lessons.show', [
            'lesson' => $lesson->load(['level.pathVersion.pathway', 'media', 'challenge']),
            'enrollment' => auth()->user()->isChild()
                ? auth()->user()->childProfile?->enrollment
                : null,
            'requestKey' => (string) Str::uuid(),
        ]);
    }
}
