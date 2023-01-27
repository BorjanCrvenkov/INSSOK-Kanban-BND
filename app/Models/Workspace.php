<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends BaseModel
{

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

}
