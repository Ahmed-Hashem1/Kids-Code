<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'path_version_id',
        'title',
        'position',
    ];

    public function pathVersion(): BelongsTo
    {
        return $this->belongsTo(PathVersion::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('position');
    }

    public function assessment(): HasOne
    {
        return $this->hasOne(Assessment::class)->where('kind', 'level_end');
    }
}
