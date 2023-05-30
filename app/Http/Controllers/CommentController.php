<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Responses\CustomResponse;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;

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
     * @param StoreCommentRequest $request
     * @return JsonResponse
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
     */
    public function destroy(Comment $comment)
    {
        return $this->destroyHelper($comment);
    }
}
