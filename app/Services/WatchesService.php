<?php

namespace App\Services;

use App\Models\Watches;

class WatchesService extends BaseService
{
    /**
     * @param Watches $model
     */
    public function __construct(Watches $model)
    {
        parent::__construct($model);
    }
}
