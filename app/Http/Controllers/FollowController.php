<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowRequest;
use App\Http\Responses\CustomResponse;
use App\Models\Follow;
use App\Services\FollowService;
use Illuminate\Http\JsonResponse;

/**
 * @group Follow routes
 *
 */
class FollowController extends Controller
{
    /**
     * @param Follow $model
     * @param FollowService $service
     * @param CustomResponse $response
     * @authenticated
     */
    public function __construct(Follow $model, FollowService $service, CustomResponse $response)
    {
        $authParam = 'follow';
        parent::__construct($model, $service, $response, $authParam);
    }

    /**
     * Follow index
     *
     * @queryParam filter['filter_name'] Available filters: user_id, task_id
     * Example: filter[user_id]=1.
     * Multiple filters example: filter[user_id]=1&filter[task_id]=1
     *
     * @return JsonResponse
     * @authenticated
     */
    public function index()
    {
        return $this->indexHelper();
    }

    /**
     * Follow store
     *
     * @param StoreFollowRequest $request
     * @return JsonResponse
     * @authenticated
     */
    public function store(StoreFollowRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * Follow show
     *
     * @param Follow $follow
     * @return JsonResponse
     * @authenticated
     */
    public function show(Follow $follow)
    {
        return $this->showHelper($follow);
    }

    /**
     * Follow delete
     *
     * @param Follow $follow
     * @return JsonResponse
     * @authenticated
     */
    public function destroy(Follow $follow)
    {
        return $this->destroyHelper($follow);
    }
}
