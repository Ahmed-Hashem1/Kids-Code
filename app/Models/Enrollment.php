<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'path_version_id',
        'start_level_id',
        'xp_total',
        'last_activity_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'last_activity_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function getRankAttribute(): string
    {
        $xp = (int) $this->xp_total;

        return match (true) {
            $xp < 100 => 'مستكشف',
            $xp < 250 => 'مبرمج واعد',
            $xp < 500 => 'محلل',
            default => 'خبير',
        };
    }

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }

    public function pathVersion(): BelongsTo
    {
        return $this->belongsTo(PathVersion::class);
    }

    public function startLevel(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'start_level_id');
    }

    public function lessonProgress(): HasMany
    {
        return $this->hasMany(LessonProgress::class);
    }

    public function challengeAttempts(): HasMany
    {
        return $this->hasMany(ChallengeAttempt::class);
    }

    public function assessmentAttempts(): HasMany
    {
        return $this->hasMany(AssessmentAttempt::class);
    }
}
