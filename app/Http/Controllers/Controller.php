<?php

namespace App\Http\Controllers;

use App\Http\Responses\CustomResponse;
use App\Models\BaseModel;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param BaseModel|User $model
     * @param BaseService $service
     * @param CustomResponse $response
     * @param string $authParam
     */
    public function __construct(public BaseModel|User $model, public BaseService $service, public CustomResponse $response, public string $authParam)
    {
        $this->authorizeResource($this->model::class, $this->authParam);
    }

    /**
     * @return JsonResponse
     */
    public function indexHelper(): JsonResponse
    {
        $modelsData = $this->service->index();

        return $this->response->success(data: $modelsData->toArray());
    }

    /**
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function storeHelper(FormRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $modelData = $this->service->store($validatedData)->toArray();

        return $this->response->success(data: $modelData);
    }

    /**
     * @param BaseModel|User $model
     * @return JsonResponse
     */
    public function showHelper(BaseModel|User $model): JsonResponse
    {
        $modelData = $this->service->show($model->getKey());

        return $this->response->success(data: $modelData->toArray());
    }

    /**
     * @param BaseModel|User $model
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function updateHelper(BaseModel|User $model, FormRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $modelData = $this->service->update($model->id, $validatedData)->toArray();

        return $this->response->success(data: $modelData);
    }

    /**
     * @param BaseModel|User $model
     * @return JsonResponse
     */
    public function destroyHelper(BaseModel|User $model): JsonResponse
    {
        $this->service->destroy($model->id);

        return $this->response->noContent();
    }
}
