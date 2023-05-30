<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColumnRequest;
use App\Http\Requests\UpdateColumnRequest;
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
        parent::__construct($model, $service, $response, $authParam);
    }

    /**
     * Column index
     *
     * Default sort: order
     *
     * @queryParam filter['filter_name'] Available filters: name, border_id
     * Example: filter[name]=test.
     * Multiple filters example: filter[name]=test&filter[border_id]=1
     *
     * @queryParam include Available includes: board, tasks
     * Example: include=board
     * Multiple includes example: include=board,task
     *
     * @return JsonResponse
     * @authenticated
     */
    public function index()
    {
        return $this->indexHelper();
    }

    /**
     * Column store
     *
     * @param StoreColumnRequest $request
     * @return JsonResponse
     * @authenticated
     */
    public function store(StoreColumnRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * Column show
     *
     * @queryParam include Available includes: board, tasks
     * Example: include=board
     * Multiple includes example: include=board,tasks
     *
     * @param Column $column
     * @return JsonResponse
     * @authenticated
     */
    public function show(Column $column)
    {
        return $this->showHelper($column);
    }

    /**
     * Column update
     *
     * @param UpdateColumnRequest $request
     * @param Column $column
     * @return JsonResponse
     * @authenticated
     */
    public function update(UpdateColumnRequest $request, Column $column)
    {
        return $this->updateHelper($column, $request);
    }

    /**
     * Column delete
     *
     * @param Column $column
     * @return JsonResponse
     * @authenticated
     */
    public function destroy(Column $column)
    {
        return $this->destroyHelper($column);
    }
}
