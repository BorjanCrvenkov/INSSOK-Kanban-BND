<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Http\Responses\CustomResponse;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        parent::__construct($model, $service, $response, UserResource::class, UserCollection::class, $authParam);
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
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user)
    {
        return $this->showHelper($user);
    }

    public function updatePost(UpdateUserRequest $request, int $id){
        $validatedData = $request->validated();

        $modelData = $this->service->update($id, $validatedData);

        return $this->response->success(data: $modelData->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        return $this->destroyHelper($user);
    }
}
