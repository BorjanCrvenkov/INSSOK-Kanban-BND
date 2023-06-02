<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserTaskCommentRequest;
use App\Http\Responses\CustomResponse;
use App\Models\UserTaskComment;
use App\Services\UserTaskCommentService;
use Illuminate\Http\JsonResponse;

/**
 * @group UserTaskComment routes
 *
 */
class UserTaskCommentController extends Controller
{
    /**
     * @param UserTaskComment $model
     * @param UserTaskCommentService $service
     * @param CustomResponse $response
     */
    public function __construct(UserTaskComment $model, UserTaskCommentService $service, CustomResponse $response)
    {
        $authParam = 'user_task_comment';
        parent::__construct($model, $service, $response, $authParam);
    }

    /**
     * UserTaskComment index
     *
     * @queryParam filter['filter_name'] Available filters: user_id, task_id, comment_id
     * Example: filter[user_id]=1.
     * Multiple filters example: filter[user_id]=1&filter[task_id]=2
     *
     * @return JsonResponse
     * @authenticated
     */
    public function index()
    {
        return $this->indexHelper();
    }

    /**
     * UserTaskComment store
     *
     * @param StoreUserTaskCommentRequest $request
     * @return JsonResponse
     * @authenticated
     */
    public function store(StoreUserTaskCommentRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * UserTaskComment show
     *
     * @param UserTaskComment $userTaskComment
     * @return JsonResponse
     * @authenticated
     */
    public function show(UserTaskComment $userTaskComment)
    {
        return $this->showHelper($userTaskComment);
    }

    /**
     * UserTaskComment delete
     *
     * @param UserTaskComment $userTaskComment
     * @return JsonResponse
     * @authenticated
     */
    public function destroy(UserTaskComment $userTaskComment)
    {
        return $this->destroyHelper($userTaskComment);
    }
}
