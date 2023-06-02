<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Responses\CustomResponse;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;

/**
 * @group Comment routes
 *
 */
class CommentController extends Controller
{
    /**
     * @param Comment $model
     * @param CommentService $service
     * @param CustomResponse $response
     */
    public function __construct(Comment $model, CommentService $service, CustomResponse $response)
    {
        $authParam = 'comment';
        parent::__construct($model, $service, $response, $authParam);
    }

    /**
     * Comment index
     *
     * @queryParam include Available includes: user, task
     * Example: include=user
     * Multiple includes example: include=user,task
     *
     * @queryParam filter['filter_name'] Available filters: name, task_id
     * Example: filter[name]=test.
     * Multiple filters example: filter[name]=test&filter[task_id]=1
     *
     * @return JsonResponse
     * @authenticated
     */
    public function index()
    {
        return $this->indexHelper();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentRequest $request
     * @return JsonResponse
     * @authenticated
     */
    public function store(StoreCommentRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return JsonResponse
     * @authenticated
     */
    public function show(Comment $comment)
    {
        return $this->showHelper($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommentRequest $request
     * @param Comment $comment
     * @return JsonResponse
     * @authenticated
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        return $this->updateHelper($comment, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return JsonResponse
     * @authenticated
     */
    public function destroy(Comment $comment)
    {
        return $this->destroyHelper($comment);
    }
}
