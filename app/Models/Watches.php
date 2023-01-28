<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watches extends BaseModel
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'task_id',
    ];
}
