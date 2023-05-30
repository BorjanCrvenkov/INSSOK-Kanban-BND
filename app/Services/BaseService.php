<?php

namespace App\Services;

use App\Models\BaseModel;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\QueryBuilder;

abstract class BaseService
{
    protected BaseModel|User $model;

    /**
     * @param BaseModel|User $model
     */
    public function __construct(BaseModel|User $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection|array
     */
    public function index(): Collection|array
    {
        $model = new $this->model();

        return QueryBuilder::for($model::class)
            ->allowedIncludes($model->allowedIncludes())
            ->allowedFilters($model->allowedFilters())
            ->defaultSorts($model->defaultSorts())
            ->allowedSorts($model->allowedSorts())
            ->get();
    }

    /**
     * @param int $id
     * @return BaseModel|User
     */
    public function show(int $id): BaseModel|User
    {
        $model = new $this->model();

        return QueryBuilder::for($model::class)
            ->allowedIncludes($model->allowedIncludes())
            ->findOrFail($id);
    }

    /**
     * @param array $data
     * @return BaseModel|User
     */
    public function store(array $data): BaseModel|User
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return BaseModel|User
     */
    public function update(int $id, array $data): BaseModel|User
    {
        $model = $this->show($id);

        $model->update($data);

        return $this->show($id);
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function destroy(int $id): bool|null
    {
        $model = $this->model->find($id);

        return $model->delete();
    }
}
