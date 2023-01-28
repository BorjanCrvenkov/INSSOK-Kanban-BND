<?php

namespace App\Services;

use App\Models\Board;

class BoardService extends BaseService
{
    /**
     * @param Board $model
     */
    public function __construct(Board $model)
    {
        parent::__construct($model);
    }
}
