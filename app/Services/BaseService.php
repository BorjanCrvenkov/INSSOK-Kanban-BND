<?php

namespace App\Services;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

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
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->model::all();
    }

    /**
     * @param int $id
     * @return BaseModel|User
     */
    public function show(int $id): BaseModel|User
    {
        return $this->model->find($id);
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
        $model = $this->model->find($id);
        $model->update($data);

        return $model;
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
