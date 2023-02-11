<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];


    /**
     * @return HasMany
     */
    public function roles(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return string[]
     */
    public function allowedFilters(): array
    {
        return [
            'name'
        ];
    }

    /**
     * @return string[]
     */
    public function allowedSorts(): array
    {
        return [
            'name',
            '-name'
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
}
