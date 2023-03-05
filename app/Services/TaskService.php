<?php

namespace App\Services;

use App\Models\BaseModel;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class TaskService extends BaseService
{
    /**
     * @param Task $model
     */
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return BaseModel|User
     */
    public function store(array $data): BaseModel|User
    {
        if(!Arr::has($data, 'reporter_id') && Auth::user()){
            $data['reporter_id'] = Auth::id();
        }
        return parent::store($data);
    }
}
