<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserWorkspaceRequest;
use App\Http\Requests\UpdateUserWorkspaceRequest;
use App\Http\Responses\CustomResponse;
use App\Models\UserWorkspace;
use App\Services\UserWorkspaceService;
use Illuminate\Http\JsonResponse;

class UserWorkspaceController extends Controller
{
    /**
     * @param UserWorkspace $model
     * @param UserWorkspaceService $service
     * @param CustomResponse $response
     */
    public function __construct(UserWorkspace $model, UserWorkspaceService $service, CustomResponse $response)
    {
        $authParam = 'user_workspace';
        parent::__construct($model, $service, $response, $authParam);
    }

    /**
     * Display a listing of the resource.
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
     * @param StoreUserWorkspaceRequest $request
     * @return JsonResponse
     * @authenticated
     */
    public function store(StoreUserWorkspaceRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * Display the specified resource.
     *
     * @param UserWorkspace $userWorkspace
     * @return JsonResponse
     * @authenticated
     */
    public function show(UserWorkspace $userWorkspace)
    {
        return $this->showHelper($userWorkspace);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserWorkspaceRequest $request
     * @param UserWorkspace $userWorkspace
     * @return JsonResponse
     * @authenticated
     */
    public function update(UpdateUserWorkspaceRequest $request, UserWorkspace $userWorkspace)
    {
        return $this->updateHelper($userWorkspace, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserWorkspace $userWorkspace
     * @return JsonResponse
     * @authenticated
     */
    public function destroy(UserWorkspace $userWorkspace)
    {
        return $this->destroyHelper($userWorkspace);
    }
}
