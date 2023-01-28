<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Http\Resources\BoardCollection;
use App\Http\Resources\BoardResource;
use App\Http\Responses\CustomResponse;
use App\Models\Board;
use App\Services\BoardService;
use Illuminate\Http\JsonResponse;

class BoardController extends Controller
{
    /**
     * @param Board $model
     * @param BoardService $service
     * @param CustomResponse $response
     */
    public function __construct(Board $model, BoardService $service, CustomResponse $response)
    {
        $authParam = 'board';
        parent::__construct($model, $service, $response, BoardResource::class, BoardCollection::class, $authParam);
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
     * @param StoreBoardRequest $request
     * @return JsonResponse
     */
    public function store(StoreBoardRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Board $board
     * @return JsonResponse
     */
    public function show(Board $board)
    {
        return $this->showHelper($board);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBoardRequest $request
     * @param Board $board
     * @return JsonResponse
     */
    public function update(UpdateBoardRequest $request, Board $board)
    {
        return $this->updateHelper($board, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Board $board
     * @return JsonResponse
     */
    public function destroy(Board $board)
    {
        return $this->destroyHelper($board);
    }
}
