<?php

namespace App\Services;

use App\Models\User;

class UserService extends BaseService
{
    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
