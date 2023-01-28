<?php

namespace App\Services;

use App\Models\Task;

class TaskService extends BaseService
{
    /**
     * @param Task $model
     */
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }
}
