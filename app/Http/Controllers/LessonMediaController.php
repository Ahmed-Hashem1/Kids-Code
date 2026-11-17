<?php

namespace App\Http\Controllers;

use App\Models\LessonMedia;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LessonMediaController extends Controller
{
    public function show(LessonMedia $media): BinaryFileResponse
    {
        Gate::authorize('view', $media);

        abort_if(
            ! $media->storage_key
                || str_starts_with($media->storage_key, '/')
                || preg_match('/(^|[\\\\\\/])\.\.([\\\\\\/]|$)/', $media->storage_key),
            404,
        );

        $disk = Storage::disk('local');
        $root = realpath($disk->path(''));
        $path = realpath($disk->path($media->storage_key));

        abort_unless(
            $root && $path
                && str_starts_with($path, $root.DIRECTORY_SEPARATOR)
                && is_file($path),
            404,
        );

        return response()->file($path, [
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
