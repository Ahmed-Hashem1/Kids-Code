<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;

class LessonPolicy
{
    public function view(User $user, Lesson $lesson): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if (! $user->isChild()) {
            return false;
        }

        $pathVersion = $lesson->level?->pathVersion;

        return $pathVersion?->status === 'published'
            && $user->childProfile?->enrollment()
                ->where('path_version_id', $pathVersion->id)
                ->exists();
    }
}
