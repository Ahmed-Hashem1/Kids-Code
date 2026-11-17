<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'lesson_id',
        'played_ranges',
        'video_done_at',
        'read_at',
        'activity_tried_at',
        'completed_at',
        'xp_awarded',
    ];

    protected function casts(): array
    {
        return [
            'played_ranges' => 'array',
            'video_done_at' => 'datetime',
            'read_at' => 'datetime',
            'activity_tried_at' => 'datetime',
            'completed_at' => 'datetime',
            'xp_awarded' => 'boolean',
        ];
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
