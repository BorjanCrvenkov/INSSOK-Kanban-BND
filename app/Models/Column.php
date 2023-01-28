<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Column extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'order',
        'border_id',
    ];

    /**
     * @return BelongsTo
     */
    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }
}
