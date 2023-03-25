<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workspace extends BaseModel
{
    protected $with = [
        'users',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * @return string[]
     */
    public function allowedFilters(): array
    {
        return [
            'name',
        ];
    }

    /**
     * @return string[]
     */
    public function allowedSorts(): array
    {
        return [
            'name',
            '-name',
        ];
    }

    /**
     * @return string[]
     */
    public function defaultSorts(): array
    {
        return [
            'name',
        ];
    }

    /**
     * @return string[]
     */
    public function allowedIncludes(): array
    {
        return [
            'boards',
            'users',
        ];
    }

    /**
     * @return HasMany
     */
    public function boards(): HasMany
    {
        return $this->hasMany(Board::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_workspaces');
    }
}
