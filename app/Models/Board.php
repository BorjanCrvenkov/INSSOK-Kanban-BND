<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Board extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'workspace_id',
    ];

    /**
     * @return BelongsTo
     */
    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }
}
