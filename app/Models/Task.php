<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'reporter_id',
        'assignee_id',
    ];

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
    public function usersWatchedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'watches');
    }
}
