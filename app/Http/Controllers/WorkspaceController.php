<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkspaceRequest;
use App\Http\Requests\UpdateWorkspaceRequest;
use App\Http\Responses\CustomResponse;
use App\Models\Workspace;
use App\Services\WorkspaceService;
use Illuminate\Http\JsonResponse;

/**
 * @group Workspace routes
 *
 */
class WorkspaceController extends Controller
{
    /**
     * @param Workspace $model
     * @param WorkspaceService $service
     * @param CustomResponse $response
     */
    public function __construct(Workspace $model, WorkspaceService $service, CustomResponse $response)
    {
        $authParam = 'workspace';
        parent::__construct($model, $service, $response, $authParam);
    }

    /**
     * Workspace index
     *
     * Default sort: name
     *
     * @queryParam filter['filter_name'] Available filters: name, user_id
     * Example: filter[name]=test.
     * Multiple filters example: filter[user_id]=1&filter[name]=test
     *
     * @queryParam sort Available sorts: name
     * Adding - before the sort name will sort in descending order.
     * Example: sort=name
     *
     * @queryParam include Available includes: boards, users
     * Example: include=boards
     * Multiple includes example: include=boards,users
     *
     * @return JsonResponse
     * @authenticated
     */
    public function index(): JsonResponse
    {
        return $this->indexHelper();
    }

    /**
     * Workspace store
     *
     * @param StoreWorkspaceRequest $request
     * @return JsonResponse
     * @authenticated
     */
    public function store(StoreWorkspaceRequest $request): JsonResponse
    {
        return $this->storeHelper($request);
    }

    /**
     * Workspace show
     *
     * @queryParam include Available includes: boards, users
     * Example: include=boards
     * Multiple includes example: include=boards,users
     *
     * @param Workspace $workspace
     * @return JsonResponse
     * @authenticated
     */
    public function show(Workspace $workspace): JsonResponse
    {
        return $this->showHelper($workspace);
    }

    /**
     * Workspace update
     *
     * @param UpdateWorkspaceRequest $request
     * @param Workspace $workspace
     * @return JsonResponse
     * @authenticated
     */
    public function update(UpdateWorkspaceRequest $request, Workspace $workspace): JsonResponse
    {
        return $this->updateHelper($workspace, $request);
    }

    /**
     * Workspace delete
     *
     * @param Workspace $workspace
     * @return JsonResponse
     * @authenticated
     */
    public function destroy(Workspace $workspace): JsonResponse
    {
        return $this->destroyHelper($workspace);
    }
}
