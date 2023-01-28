<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationRequests\LoginRequest;
use App\Http\Requests\AuthenticationRequests\RegisterRequest;
use App\Http\Responses\CustomResponse;
use App\Services\UserService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class AuthenticationController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param UserService $userService
     * @param CustomResponse $customResponse
     */
    public function __construct(public UserService $userService, public CustomResponse $customResponse)
    {
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function register(RegisterRequest $request){
        $validated_data = $request->validated();

        $image_name = $this->storeImage($validated_data['image']);
        $validated_data['image'] = $image_name;
        $validated_data['role_id'] = Role::where('name', '=', 'user');

        $user = $this->userService->store($validated_data);

        return $this->customResponse->success(data: $user->toArray());
    }

    /**
     * @param $image
     * @return string
     * @throws Exception
     */
    private function storeImage($image){
        $image_name = time() . random_int(1, 1000) . '.' . $image->extension();
        $destination_path = 'userImages/';
        $image->move($destination_path, $image_name);

        return $image_name;
    }

    public function login(LoginRequest $request){
        $login_data = $request->validated();

        if(!Auth::attempt($login_data)){
            return $this->customResponse->invalidLoginCredentials();
        }

        $user = Auth::user();
        $token = $user->createToken('INSSOK-Kanban-App');

        return $this->customResponse->success('Successfully logged in user.', data: $user->toArray(), auth: $token->toArray());
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
