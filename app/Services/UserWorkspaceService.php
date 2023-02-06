<?php

namespace App\Services;

use App\Models\UserWorkspace;

class UserWorkspaceService extends BaseService
{
    /**
     * @param UserWorkspace $model
     */
    public function __construct(UserWorkspace $model)
    {
        parent::__construct($model);
    }
}
