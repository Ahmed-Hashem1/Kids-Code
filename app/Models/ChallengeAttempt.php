<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChallengeAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'challenge_id',
        'request_key',
        'response',
        'is_correct',
        'stars',
    ];

    protected function casts(): array
    {
        return [
            'response' => 'array',
            'is_correct' => 'boolean',
        ];
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function challenge(): BelongsTo
    {
        return $this->belongsTo(Challenge::class);
    }
}
