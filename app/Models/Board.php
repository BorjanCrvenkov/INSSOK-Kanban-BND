<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\QueryBuilder\AllowedFilter;

class Board extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'workspace_id',
        'task_prefix',
    ];

    /**
     * @return array
     */
    public function allowedFilters(): array
    {
        return [
            'name',
            'description',
            AllowedFilter::exact('workspace_id'),
        ];
    }

    /**
     * @return string[]
     */
    public function allowedSorts(): array
    {
        return [
            'name',
            'description',
            'workspace_id',
            '-name',
            '-description',
            '-workspace_id',
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
            'workspace',
            'columns',
            'columns.tasks',
            'workspace.users',
        ];
    }

    /**
     * @return BelongsTo
     */
    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    /**
     * @return HasMany
     */
    public function columns(): HasMany
    {
        return $this->hasMany(Column::class)->orderBy('order');
    }

    /**
     * @return Collection|Builder|array
     */
    public function tasks(): Collection|Builder|array
    {
        return Task::query()
            ->join('columns', 'tasks.column_id', '=', 'columns.id')
            ->where('columns.board_id', '=', $this->getKey())->get();
    }
}
