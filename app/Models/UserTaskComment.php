<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedFilter;

class UserTaskComment extends BaseModel
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'comment_id',
        'task_id',
    ];

    /**
     * @return array
     */
    public function allowedFilters(): array
    {
        return [
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('comment_id'),
            AllowedFilter::exact('task_id'),
        ];
    }

    /**
     * @return string[]
     */
    public function allowedSorts(): array
    {
        return [
            'created_at',
            '-created_at',
        ];
    }

    /**
     * @return string[]
     */
    public function defaultSorts(): array
    {
        return [
            'created_at',
        ];
    }
}
