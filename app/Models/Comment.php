<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Spatie\QueryBuilder\AllowedFilter;

class Comment extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'body',
    ];

    /**
     * @return string[]
     */
    public function allowedFilters(): array
    {
        return [
            'name',
            AllowedFilter::scope('task_id'),
        ];
    }

    /**
     * @return string[]
     */
    public function allowedIncludes(): array
    {
        return [
            'user',
        ];
    }

    /**
     * @param $query
     * @param $task_id
     * @return void
     */
    public function scopeTaskId($query, $task_id): void
    {
        $query->whereExists(function ($query) use ($task_id){
            $query->select('id')
                ->from('user_task_comments')
                ->where('user_task_comments.task_id', '=', $task_id)
            ->whereColumn('comments.id', '=', 'user_task_comments.comment_id');
        });
    }

    /**
     * @return HasOneThrough
     */
    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(
            User::class,
            UserTaskComment::class,
            'comment_id',
            'id',
            'id',
            'user_id'
        );
    }
}
