<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'icon',
        'rule_type',
        'rule_value',
    ];

    public function children(): BelongsToMany
    {
        return $this->belongsToMany(Child::class, 'child_badges')->withPivot('earned_at');
    }

    public function childBadges(): HasMany
    {
        return $this->hasMany(ChildBadge::class);
    }
}
