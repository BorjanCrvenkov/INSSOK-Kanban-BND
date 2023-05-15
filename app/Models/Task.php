<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\QueryBuilder\AllowedFilter;

class Task extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'priority',
        'due_date',
        'type',
        'order',
        'column_id',
        'reporter_id',
        'assignee_id',
        'label',
    ];

    /**
     * @return array
     */
    public function allowedFilters(): array
    {
        return [
            'title',
            'description',
            'priority',
            'due_date',
            'type',
            AllowedFilter::exact('reporter_id'),
            AllowedFilter::exact('assignee_id'),
        ];
    }

    /**
     * @return string[]
     */
    public function allowedIncludes(): array
    {
        return [
            'column',
            'assignee',
            'reporter',
            'users_followed_by',
            'comments',
        ];
    }

    /**
     * @return string[]
     */
    public function defaultSorts(): array
    {
        return [
            'order',
            'id',
        ];
    }

    /**
     * @return BelongsTo
     */
    public function column(): BelongsTo
    {
        return $this->belongsTo(Column::class);
    }

    /**
     * @return BelongsTo
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function users_followed_by(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows');
    }

    /**
     * @return HasManyThrough
     */
    public function comments(): HasManyThrough
    {
        return $this->hasManyThrough(Comment::class,
            UserTaskComment::class,
            'task_id',
            'id',
            'id',
            'comment_id'
        );
    }
}
