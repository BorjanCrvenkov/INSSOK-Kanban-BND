<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\QueryBuilder\AllowedFilter;

class Column extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'order',
        'board_id',
    ];

    /**
     * @return array
     */
    public function allowedFilters(): array
    {
        return [
            'name',
            AllowedFilter::exact('border_id'),
        ];
    }

    /**
     * @return string[]
     */
    public function defaultSorts(): array
    {
        return [
            'order',
        ];
    }

    /**
     * @return string[]
     */
    public function allowedIncludes(): array
    {
        return [
            'board',
            'tasks',
        ];
    }

    /**
     * @return BelongsTo
     */
    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }

    /**
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
