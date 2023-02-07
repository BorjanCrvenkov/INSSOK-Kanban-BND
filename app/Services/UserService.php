<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Http\Responses\CustomResponse;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserService extends BaseService
{
    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return User
     * @throws Exception
     */
    public function store(array $data): User
    {
        if(Arr::has($data, 'role_id')){
            $data['role_id'] = Role::where('name' ,'=', RoleEnum::USER->value);
        }

        $image_name = $this->storeImage($data['image']);
        $data['image'] = $image_name;

        return parent::store($data);
    }

    /**
     * @param $image
     * @return string
     * @throws Exception
     */
    private function storeImage($image): string
    {
        $image_name = time() . random_int(1, 1000) . '.' . $image->extension();
        $destination_path = 'userImages/';
        $image->move($destination_path, $image_name);

        return $image_name;
    }

    /**
     * @param array $data
     * @param CustomResponse $response
     * @return JsonResponse
     */
    public function login(array $data, CustomResponse $response): JsonResponse
    {
        if(!Auth::attempt($data)){
            return $response->invalidLoginCredentials();
        }

        $user = Auth::user();
        $token = $user->createToken('INSSOK-Kanban-App');

        return $response->success('Successfully logged in user.', data: $user->toArray(), auth: $token->toArray());
    }

}
