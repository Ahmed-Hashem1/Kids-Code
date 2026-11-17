<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_user_id',
        'parent_user_id',
        'display_name',
        'age_group',
        'avatar',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'child_user_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent_user_id');
    }

    public function enrollment(): HasOne
    {
        return $this->hasOne(Enrollment::class);
    }

    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class, 'child_badges')->withPivot('earned_at');
    }

    public function childBadges(): HasMany
    {
        return $this->hasMany(ChildBadge::class);
    }
}
