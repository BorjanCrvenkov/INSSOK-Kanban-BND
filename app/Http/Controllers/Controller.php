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

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct(public BaseModel|User $model, public BaseService $service, public CustomResponse $response,
                                public string $resource, public string $collection)
    {

    }

    /**
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function indexHelper(FormRequest $request): JsonResponse
    {
        $modelsData = $this->service->index();

        $models = new $this->collection($modelsData);

        return $this->response->success(data: $models);
    }

    /**
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function storeHelper(FormRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $modelData = new $this->resource($this->service->store($validatedData));

        return $this->response->success(data: $modelData);
    }

    /**
     * @param BaseModel|User $model
     * @return JsonResponse
     */
    public function showHelper(BaseModel|User $model): JsonResponse
    {
        $modelData = new $this->resource($model);

        return $this->response->success(data: $modelData);
    }

    /**
     * @param BaseModel|User $model
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function updateHelper(BaseModel|User $model, FormRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $modelData = new $this->resource($this->service->update($model->id, $validatedData));

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
