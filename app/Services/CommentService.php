<?php

namespace App\Services;

use App\Models\Comment;

class CommentService extends BaseService
{
    /**
     * @param Comment $model
     */
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }
}
