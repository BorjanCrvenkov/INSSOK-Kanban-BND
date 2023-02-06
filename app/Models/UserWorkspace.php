<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
