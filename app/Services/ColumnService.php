<?php

namespace App\Services;

use App\Models\Column;

class ColumnService extends BaseService
{
    /**
     * @param Column $model
     */
    public function __construct(Column $model)
    {
        parent::__construct($model);
    }

}
