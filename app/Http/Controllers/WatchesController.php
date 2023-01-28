<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWatchesRequest;
use App\Http\Requests\UpdateWatchesRequest;
use App\Http\Resources\WatchesCollection;
use App\Http\Resources\WatchesResource;
use App\Http\Responses\CustomResponse;
use App\Models\Watches;
use App\Services\WatchesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class WatchesController extends Controller
{
    /**
     * @param Watches $model
     * @param WatchesService $service
     * @param CustomResponse $response
     */
    public function __construct(Watches $model, WatchesService $service, CustomResponse $response)
    {
        $authParam = 'watches';
        parent::__construct($model, $service, $response, WatchesResource::class, WatchesCollection::class, $authParam);
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
     * @param StoreWatchesRequest $request
     * @return JsonResponse
     */
    public function store(StoreWatchesRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Watches $watches
     * @return JsonResponse
     */
    public function show(Watches $watches)
    {
        return $this->showHelper($watches);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Watches $watches
     * @return JsonResponse
     */
    public function destroy(Watches $watches)
    {
        return $this->destroyHelper($watches);
    }
}
