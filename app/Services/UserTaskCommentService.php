<?php

namespace App\Services;

use App\Models\UserTaskComment;

class UserTaskCommentService extends BaseService
{
    /**
     * @param UserTaskComment $model
     */
    public function __construct(UserTaskComment $model)
    {
        parent::__construct($model);
    }
}
