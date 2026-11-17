<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
}
