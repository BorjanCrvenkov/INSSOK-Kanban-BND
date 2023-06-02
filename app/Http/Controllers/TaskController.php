<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Responses\CustomResponse;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

/**
 * @group Task routes
 *
 */
class TaskController extends Controller
{
    /**
     * @param Task $model
     * @param TaskService $service
     * @param CustomResponse $response
     */
    public function __construct(Task $model, TaskService $service, CustomResponse $response)
    {
        $authParam = 'task';
        parent::__construct($model, $service, $response, $authParam);
    }

    /**
     * Task index
     *
     * Default sort: order
     *
     * @queryParam filter['filter_name'] Available filters: title, description, priority, due_date, type, reporter_id, assignee_id
     * Example: filter[title]=test.
     * Multiple filters example: filter[title]=test&filter[priority]=low
     *
     * @queryParam include Available includes: column, assignee, reporter, users_followed_by, comments
     * Example: include=column
     * Multiple includes example: include=column,assignee
     *
     * @return JsonResponse
     * @authenticated
     */
    public function index()
    {
        return $this->indexHelper();
    }

    /**
     * Task store
     *
     * @param StoreTaskRequest $request
     * @return JsonResponse
     * @authenticated
     */
    public function store(StoreTaskRequest $request)
    {
        return $this->storeHelper($request);
    }

    /**
     * Task show
     *
     * @queryParam include Available includes: column, assignee, reporter, users_followed_by, comments
     * Example: include=column
     * Multiple includes example: include=column,assignee
     *
     * @param Task $task
     * @return JsonResponse
     * @authenticated
     */
    public function show(Task $task)
    {
        return $this->showHelper($task);
    }

    /**
     * Task update
     *
     * @param UpdateTaskRequest $request
     * @param Task $task
     * @return JsonResponse
     * @authenticated
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        return $this->updateHelper($task, $request);
    }

    /**
     * Task delete
     *
     * @param Task $task
     * @return JsonResponse
     * @authenticated
     */
    public function destroy(Task $task)
    {
        return $this->destroyHelper($task);
    }
}
