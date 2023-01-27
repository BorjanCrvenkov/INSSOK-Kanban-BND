<?php

namespace App\Services;

use App\Models\Workspace;

class WorkspaceService extends BaseService
{
    /**
     * @param Workspace $model
     */
    public function __construct(Workspace $model)
    {
        parent::__construct($model);
    }
}
