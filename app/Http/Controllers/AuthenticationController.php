<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Responses\CustomResponse;
use App\Services\UserService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param UserService $user_service
     * @param CustomResponse $customResponse
     */
    public function __construct(public UserService $user_service, public CustomResponse $customResponse)
    {
    }

    /**
     * @param StoreUserRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function register(StoreUserRequest $request){
        $validated_data = $request->validated();

        $user = $this->user_service->store($validated_data);

        return $this->customResponse->success(data: $user->toArray());
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request){
        $validated_data = $request->validated();

        return $this->user_service->login($validated_data, $this->customResponse);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return $this->customResponse->noContent();
    }

    /**
     * @return JsonResponse
     */
    public function getAuthenticatedUser(): JsonResponse
    {
        return $this->customResponse->success(data: Auth::user()->toArray());
    }

    /**
     * @return JsonResponse
     */
    public function refreshToken(): JsonResponse
    {
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        $token = $user->createToken('INSSOK-Kanban-App');

        return $this->customResponse->success(message: "Successfully refreshed the authenticated users token", auth: $token->toArray());
    }
}
