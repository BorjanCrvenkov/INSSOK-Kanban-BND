<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Responses\CustomResponse;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;

/**
 * @group Role routes
 *
 */
class RoleController extends Controller
{
    /**
     * @param Role $model
     * @param RoleService $service
     * @param CustomResponse $response
     */
    public function __construct(Role $model, RoleService $service, CustomResponse $response)
    {
        $authParam = 'role';
        parent::__construct($model, $service, $response, $authParam);
    }

    /**
     * Role index
     *
     * Default sort: name
     *
     * @queryParam filter['filter_name'] Available filters: name
     * Example: filter[name]=test.
     *
     * @queryParam sort Available sorts: name
     * Adding - before the sort name will sort in descending order.
     * Example: sort=name
     *
     * @return JsonResponse
     * @authenticated
     */
    public function index()
    {
        return $this->indexHelper();
    }

    /**
     * Role store
     *
     * @param StoreRoleRequest $request
     * @return JsonResponse
     * @authenticated
     */
    public function store(StoreRoleRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * Role show
     *
     * @param Role $role
     * @return JsonResponse
     * @authenticated
     */
    public function show(Role $role)
    {
        return $this->showHelper($role);
    }

    /**
     * Role update
     *
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return JsonResponse
     * @authenticated
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        return $this->updateHelper($role, $request);
    }

    /**
     * Role delete
     *
     * @param Role $role
     * @return JsonResponse
     * @authenticated
     */
    public function destroy(Role $role)
    {
        return $this->destroyHelper($role);
    }
}
