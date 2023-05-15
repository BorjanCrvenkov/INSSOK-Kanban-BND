<?php

namespace App\Services;

use App\Models\Follow;

class FollowService extends BaseService
{
    /**
     * @param Follow $model
     */
    public function __construct(Follow $model)
    {
        parent::__construct($model);
    }
}
