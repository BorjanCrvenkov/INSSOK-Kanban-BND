<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'body',
    ];


    /**
     * @return BelongsToMany
     */
    public function userCommented(): BelongsToMany //dali e ok imeto na funkcijava?
    {
        return $this->belongsToMany(User::class, 'user-task-comment'); // da se implement user-task-comment
    }

    /**
     * @return BelongsToMany
     */
    public function commentOnTask(): BelongsToMany //dali e ok imeto na funkcijava?
    {
        return $this->belongsToMany(Task::class, 'user-task-comment'); // da se implement user-task-comment
    }
}
