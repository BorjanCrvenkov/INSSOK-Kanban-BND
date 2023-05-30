<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Http\Responses\CustomResponse;
use App\Models\Board;
use App\Services\BoardService;
use Illuminate\Http\JsonResponse;

/**
 * @group Board routes
 *
 */
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
        parent::__construct($model, $service, $response, $authParam);
    }


    /**
     * Board index
     *
     * Default sort: name
     *
     * @queryParam filter['filter_name'] Available filters: name, description, workspace_id.
     * Example: filter[name]=test.
     * Multiple filters example: filter[name]=test&filter[workspace_id]=1.
     *
     * @queryParam sort Available sorts: name, description, workspace_id.
     * Adding - before the sort name will sort in descending order.
     * Example: sort=name.
     * Multiple sorts example: sort=name,workspace_id.
     *
     * @queryParam include Available includes: workspace, columns, columns.tasks, columns.tasks.assignee, columns.tasks.reporter, columns.tasks.comments, columns.tasks.comments.user, workspace.users
     * Example: include=workspace
     * Multiple includes example: include=workspace,columns
     *
     * @return JsonResponse
     * @authenticated
     */
    public function index()
    {
        return $this->indexHelper();
    }

    /**
     * Boards store
     *
     * @param StoreBoardRequest $request
     * @return JsonResponse
     * @authenticated
     */
    public function store(StoreBoardRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * Board show
     *
     * @queryParam include Available includes: workspace, columns, columns.tasks, columns.tasks.assignee, columns.tasks.reporter, columns.tasks.comments, columns.tasks.comments.user, workspace.users
     * Example: include=workspace
     * Multiple includes example: include=workspace,columns
     *
     * @param Board $board
     * @return JsonResponse
     * @authenticated
     */
    public function show(Board $board)
    {
        return $this->showHelper($board);
    }

    /**
     * Board update
     *
     * @param UpdateBoardRequest $request
     * @param Board $board
     * @return JsonResponse
     * @authenticated
     */
    public function update(UpdateBoardRequest $request, Board $board)
    {
        return $this->updateHelper($board, $request);
    }

    /**
     * Board delete
     *
     * @param Board $board
     * @return JsonResponse
     * @authenticated
     */
    public function destroy(Board $board)
    {
        return $this->destroyHelper($board);
    }
}
