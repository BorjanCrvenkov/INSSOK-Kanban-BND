<?php

namespace App\Services;

use App\Models\BaseModel;
use App\Models\User;
use App\Models\UserWorkspace;
use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;

class WorkspaceService extends BaseService
{
    /**
     * @param Workspace $model
     */
    public function __construct(Workspace $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return BaseModel|User
     */
    public function store(array $data): BaseModel|User
    {
        $workspace = $this->model->create($data);

        $user_workspace_data = [
            'user_id' => Auth::id(),
            'workspace_id' => $workspace->getKey(),
        ];

        UserWorkspace::create($user_workspace_data);

        return $workspace;
    }


}
