<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;

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
            AllowedFilter::scope('user_id')->default(Auth::id()),
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
        return $this->belongsToMany(User::class, 'user_workspaces')->withPivot('access_type');
    }

    /**
     * @param $query
     * @param $user_id
     * @return void
     */
    public function scopeUserId($query, $user_id): void
    {
        if (Auth::user()->is_admin) {
            return;
        }

        $query->join('user_workspaces', 'workspaces.id', '=', 'user_workspaces.workspace_id')
            ->where('user_id', '=', $user_id);
    }
}
