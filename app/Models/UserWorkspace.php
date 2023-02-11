<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedFilter;

class UserWorkspace extends BaseModel
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'workspace_id',
        'access_type',
    ];

    /**
     * @return array
     */
    public function allowedFilters(): array
    {
        return [
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('workspace_id'),
            'access_type',
        ];
    }

    /**
     * @return string[]
     */
    public function allowedSorts(): array
    {
        return [
            'access_type',
            '-access_type',
        ];
    }
}
