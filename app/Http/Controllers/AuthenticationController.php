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

/**
 * @group Authentication routes
 *
 */
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
     * Register
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     * @throws Exception
     * @unauthenticated
     */
    public function register(StoreUserRequest $request)
    {
        $validated_data = $request->validated();

        $user = $this->user_service->store($validated_data);

        return $this->customResponse->success(data: $user->toArray());
    }

    /**
     * Login
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @unauthenticated
     */
    public function login(LoginRequest $request)
    {
        $validated_data = $request->validated();

        return $this->user_service->login($validated_data, $this->customResponse);
    }

    /**
     * Logout
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return $this->customResponse->noContent();
    }

    /**
     * Return authenticated user
     *
     * @return JsonResponse
     * @authenticated
     */
    public function getAuthenticatedUser(): JsonResponse
    {
        return $this->customResponse->success(data: Auth::user()->toArray());
    }

    /**
     * Refresh token
     *
     * @return JsonResponse
     * @authenticated
     */
    public function refreshToken(): JsonResponse
    {
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        $token = $user->createToken('INSSOK-Kanban-App');

        return $this->customResponse->success(message: "Successfully refreshed the authenticated users token", auth: $token->toArray());
    }
}
