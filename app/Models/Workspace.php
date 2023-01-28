<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Workspace extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * @return HasMany
     */
    public function boards(): HasMany
    {
        return $this->hasMany(Board::class);
    }

}
