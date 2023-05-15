<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedFilter;

class Follow extends BaseModel
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'task_id',
    ];

    /**
     * @return array
     */
    public function allowedFilters(): array
    {
        return [
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('task_id'),
        ];
    }
}
