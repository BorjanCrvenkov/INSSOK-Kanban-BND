<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserWorkspaceRequest;
use App\Http\Requests\UpdateUserWorkspaceRequest;
use App\Http\Responses\CustomResponse;
use App\Models\UserWorkspace;
use App\Services\UserWorkspaceService;
use Illuminate\Http\JsonResponse;

/**
 * @group UserWorkspace routes
 *
 */
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
     * UserWorkspace index
     *
     * @queryParam filter['filter_name'] Available filters: user_id, workspace_id, access_type
     * Example: filter[user_id]=1.
     * Multiple filters example: filter[user_id]=1&filter[workspace_id]=1
     *
     * @queryParam sort Available sorts: access_type
     * Adding - before the sort name will sort in descending order.
     * Example: sort=access_type
     *
     * @return JsonResponse
     * @authenticated
     */
    public function index()
    {
        return $this->indexHelper();
    }

    /**
     * UserWorkspace store
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
     * UserWorkspace show
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
     * UserWorkspace update
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
     * UserWorkspace delete
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
