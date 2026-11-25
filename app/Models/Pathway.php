<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{HasMany, HasOne};


class Pathway extends Model
{
    use HasFactory;

    protected $fillable = [
        'age_group',
        'title',
        'slug',
    ];

    public function versions(): HasMany
    {
        return $this->hasMany(PathVersion::class);
    }

    public function publishedVersion(): HasOne
    {
        return $this->hasOne(PathVersion::class)->where('status', 'published');
    }
    use SoftDeletes;
}
