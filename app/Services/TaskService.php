<?php

namespace App\Services;

use App\Jobs\NotifyFollowersAboutTaskUpdateJob;
use App\Mail\TaskUpdatedMail;
use App\Models\BaseModel;
use App\Models\Column;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\isEmpty;

class TaskService extends BaseService
{
    /**
     * @param Task $model
     */
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return BaseModel|User
     */
    public function store(array $data): BaseModel|User
    {
        if (!Arr::has($data, 'reporter_id') && Auth::user()) {
            $data['reporter_id'] = Auth::id();
        }

        $task = parent::store($data);

        $this->setTaskLabel($task);

        return $this->show($task->getKey());
    }

    /**
     * @param Task|BaseModel $task
     * @return void
     */
    private function setTaskLabel(Task|BaseModel $task): void
    {
        $board = $task->column->board;
        $board_tasks_count = $board->tasks()->count();
        $label = $board->task_prefix . '-' . $board_tasks_count;

        $task->update([
            'label' => $label,
        ]);
    }

    public function update(int $id, array $data): BaseModel|User
    {
        $task = $this->show($id);

        $oldAttributes = $task->getAttributes();

        $task->update($data);

        $changes = $task->getChanges();

        if(!empty($changes)){
            $followers = $task->users_followed_by;

            foreach ($followers as $follower){
                Mail::to($follower->email)->send(new TaskUpdatedMail($task, $oldAttributes, $changes));
            }
        }

        return  $task;
    }
}
