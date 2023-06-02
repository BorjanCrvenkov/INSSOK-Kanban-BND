<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserTaskCommentRequest;
use App\Http\Responses\CustomResponse;
use App\Models\UserTaskComment;
use App\Services\UserTaskCommentService;
use Illuminate\Http\JsonResponse;

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
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return $this->indexHelper();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserTaskCommentRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserTaskCommentRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * Display the specified resource.
     *
     * @param UserTaskComment $userTaskComment
     * @return JsonResponse
     */
    public function show(UserTaskComment $userTaskComment)
    {
        return $this->showHelper($userTaskComment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserTaskComment $userTaskComment
     * @return JsonResponse
     */
    public function destroy(UserTaskComment $userTaskComment)
    {
        return $this->destroyHelper($userTaskComment);
    }
}
