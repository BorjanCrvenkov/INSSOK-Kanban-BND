<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Responses\CustomResponse;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

/**
 * @group User routes
 *
 */
class UserController extends Controller
{
    /**
     * @param User $model
     * @param UserService $service
     * @param CustomResponse $response
     */
    public function __construct(User $model, UserService $service, CustomResponse $response)
    {
        $authParam = 'user';
        parent::__construct($model, $service, $response, $authParam);
    }

    /**
     * User index
     *
     * @queryParam filter['filter_name'] Available filters: first_name, last_name, username, email, workspace_id
     * Example: filter[name]=first_name.
     * Multiple filters example: filter[first_name]=test&filter[last_name]=test
     *
     * @queryParam sort Available sorts: first_name, last_name, username, email,
     * Adding - before the sort name will sort in descending order.
     * Example: sort=first_name
     * Multiple sorts example: sort=first_name,last_name
     *
     * @queryParam include Available includes: assigned_tasks, reported_tasks, followed_tasks, workspaces
     * Example: include=assigned_tasks
     * Multiple includes example: include=assigned_tasks, workspaces
     *
     * @return JsonResponse
     * @authenticated
     */
    public function index()
    {
        return $this->indexHelper();
    }

    /**
     * User store
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     * @authenticated
     */
    public function store(StoreUserRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * User show
     *
     * @queryParam include Available includes: assigned_tasks, reported_tasks, followed_tasks, workspaces
     * Example: include=assigned_tasks
     * Multiple includes example: include=assigned_tasks, workspaces
     *
     * @param User $user
     * @return JsonResponse
     * @authenticated
     */
    public function show(User $user)
    {
        return $this->showHelper($user);
    }

    /**
     * User update
     *
     * @param UpdateUserRequest $request
     * @param int $id
     * @return JsonResponse
     * @authenticated
     */
    public function updatePost(UpdateUserRequest $request, int $id)
    {
        $validatedData = $request->validated();

        $modelData = $this->service->update($id, $validatedData);

        return $this->response->success(data: $modelData->toArray());
    }

    /**
     * User delete
     * @param User $user
     * @return JsonResponse
     * @authenticated
     */
    public function destroy(User $user)
    {
        return $this->destroyHelper($user);
    }
}
