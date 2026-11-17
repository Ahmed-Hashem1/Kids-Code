<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'kind',
        'prompt',
        'hint',
        'config',
        'grading_key',
    ];

    protected $hidden = [
        'grading_key',
    ];

    protected function casts(): array
    {
        return [
            'config' => 'array',
            'grading_key' => 'array',
        ];
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(ChallengeAttempt::class);
    }
}
