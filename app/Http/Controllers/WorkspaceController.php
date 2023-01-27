<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkspaceRequest;
use App\Http\Requests\UpdateWorkspaceRequest;
use App\Http\Resources\WorkspaceCollection;
use App\Http\Resources\WorkspaceResource;
use App\Http\Responses\CustomResponse;
use App\Models\Workspace;
use App\Services\WorkspaceService;
use Illuminate\Http\JsonResponse;

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
        parent::__construct($model, $service, $response, WorkspaceResource::class, WorkspaceCollection::class, $authParam);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->indexHelper();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWorkspaceRequest $request
     * @return JsonResponse
     */
    public function store(StoreWorkspaceRequest $request): JsonResponse
    {
        return $this->storeHelper($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Workspace $workspace
     * @return JsonResponse
     */
    public function show(Workspace $workspace): JsonResponse
    {
        return $this->showHelper($workspace);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorkspaceRequest $request
     * @param Workspace $workspace
     * @return JsonResponse
     */
    public function update(UpdateWorkspaceRequest $request, Workspace $workspace): JsonResponse
    {
        return $this->updateHelper($workspace, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Workspace $workspace
     * @return JsonResponse
     */
    public function destroy(Workspace $workspace): JsonResponse
    {
        return $this->destroyHelper($workspace);
    }
}