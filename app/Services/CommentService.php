<?php

namespace App\Services;

use App\Models\BaseModel;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentService extends BaseService
{
    /**
     * @param Comment $model
     * @param UserTaskCommentService $user_task_comment_service
     */
    public function __construct(Comment $model, public UserTaskCommentService $user_task_comment_service)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return BaseModel|User
     */
    public function store(array $data): BaseModel|User
    {
        $comment = parent::store($data);

        $this->storeUserTaskComment($comment, $data);

        return $comment;
    }

    /**
     * @param Comment|BaseModel $comment
     * @param array $data
     * @return void
     */
    private function storeUserTaskComment(Comment|BaseModel $comment, array $data): void
    {
        $user_task_comment_data = [
            'user_id'    => Auth::id(),
            'task_id'    => $data['task_id'],
            'comment_id' => $comment->getKey(),
        ];

        $this->user_task_comment_service->store($user_task_comment_data);
    }
}
