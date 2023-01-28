<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColumnRequest;
use App\Http\Requests\UpdateColumnRequest;
use App\Http\Resources\ColumnCollection;
use App\Http\Resources\ColumnResource;
use App\Http\Responses\CustomResponse;
use App\Models\Column;
use App\Services\ColumnService;
use Illuminate\Http\JsonResponse;

class ColumnController extends Controller
{
    /**
     * @param Column $model
     * @param ColumnService $service
     * @param CustomResponse $response
     */
    public function __construct(Column $model, ColumnService $service, CustomResponse $response)
    {
        $authParam = 'column';
        parent::__construct($model, $service, $response, ColumnResource::class, ColumnCollection::class, $authParam);
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
     * @param StoreColumnRequest $request
     * @return JsonResponse
     */
    public function store(StoreColumnRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Column $column
     * @return JsonResponse
     */
    public function show(Column $column)
    {
        return $this->showHelper($column);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateColumnRequest $request
     * @param Column $column
     * @return JsonResponse
     */
    public function update(UpdateColumnRequest $request, Column $column)
    {
        return $this->updateHelper($column, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Column $column
     * @return JsonResponse
     */
    public function destroy(Column $column)
    {
        return $this->destroyHelper($column);
    }
}
