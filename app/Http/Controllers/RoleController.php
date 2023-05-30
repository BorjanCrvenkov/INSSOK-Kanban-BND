<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Responses\CustomResponse;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;

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
     * @param StoreRoleRequest $request
     * @return JsonResponse
     */
    public function store(StoreRoleRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function show(Role $role)
    {
        return $this->showHelper($role);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return JsonResponse
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        return $this->updateHelper($role, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role)
    {
        return $this->destroyHelper($role);
    }
}
