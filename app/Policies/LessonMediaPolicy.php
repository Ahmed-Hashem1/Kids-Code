<?php

namespace App\Policies;

use App\Models\LessonMedia;
use App\Models\User;

class LessonMediaPolicy
{
    public function view(User $user, LessonMedia $media): bool
    {
        return app(LessonPolicy::class)->view($user, $media->lesson);
    }
}
