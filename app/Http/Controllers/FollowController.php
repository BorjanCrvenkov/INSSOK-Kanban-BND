<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowRequest;
use App\Http\Responses\CustomResponse;
use App\Models\Follow;
use App\Services\FollowService;
use Illuminate\Http\JsonResponse;

class FollowController extends Controller
{
    /**
     * @param Follow $model
     * @param FollowService $service
     * @param CustomResponse $response
     */
    public function __construct(Follow $model, FollowService $service, CustomResponse $response)
    {
        $authParam = 'follow';
        parent::__construct($model, $service, $response, $authParam);
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
     * @param StoreFollowRequest $request
     * @return JsonResponse
     */
    public function store(StoreFollowRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Follow $follow
     * @return JsonResponse
     */
    public function show(Follow $follow)
    {
        return $this->showHelper($follow);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Follow $follow
     * @return JsonResponse
     */
    public function destroy(Follow $follow)
    {
        return $this->destroyHelper($follow);
    }
}
