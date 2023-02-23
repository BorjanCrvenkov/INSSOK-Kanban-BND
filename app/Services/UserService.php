<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Http\Responses\CustomResponse;
use App\Models\BaseModel;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserService extends BaseService
{
    final public const IMAGE_DESTINATION_PATH =  'userImages/';
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
        if (!Arr::has($data, 'role_id')) {
            $data['role_id'] = Role::where('name', '=', RoleEnum::USER->value)->first()->getKey();
        }

        $data = $this->resolveImageNameAndLinkAndSaveImage($data);

        return parent::store($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return BaseModel|User
     * @throws Exception
     */
    public function update(int $id, array $data): BaseModel|User
    {
        $user = User::find($id);

        $data = $this->resolveImageNameAndLinkAndSaveImage($data, $user);

        $user->update($data);

        return $user;
    }

    public function destroy(int $id): bool|null
    {
        $user = User::find($id);

        $this->deleteImage($user->image_name);

        return $user->delete();
    }


    /**
     * @param array $data
     * @param User|null $user
     * @return array
     */
    private function resolveImageNameAndLinkAndSaveImage(array $data, ?User $user = null): array
    {
        if(!Arr::has($data, 'image')){
            return $data;
        }

        $image = $data['image'];
        $image_name = time() . '_' . $image->getClientOriginalName();

        $destination_path = self::IMAGE_DESTINATION_PATH;

        $image->move($destination_path, $image_name);

        $app_url = config('app.url');

        $data['image_name'] = $image_name;
        $data['image_link'] = $app_url . '/'. $destination_path . $image_name;

        if(isset($user)){
            $old_user_image_name = $user->image_name;
            $this->deleteImage($old_user_image_name);
        }

        return $data;
    }

    /**
     * @param string $image_name
     * @return void
     */
    private function deleteImage(string $image_name){
        $destination_path = self::IMAGE_DESTINATION_PATH . $image_name;

        if(!File::exists($destination_path)){
            return;
        }
        File::delete($destination_path);
    }

    /**
     * @param array $data
     * @param CustomResponse $response
     * @return JsonResponse
     */
    public function login(array $data, CustomResponse $response): JsonResponse
    {
        if (!Auth::attempt($data)) {
            return $response->invalidLoginCredentials();
        }

        $user = Auth::user();
        $token = $user->createToken('INSSOK-Kanban-App');

        return $response->success('Successfully logged in user.', data: $user->toArray(), auth: $token->toArray());
    }

}
