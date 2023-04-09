<?php

namespace App\Services;

use App\Jobs\UpdateTasksLabelAfterBoardTaskPrefixIsUpdatedJob;
use App\Models\BaseModel;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Arr;

class BoardService extends BaseService
{
    /**
     * @param Board $model
     */
    public function __construct(Board $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @param array $data
     * @return BaseModel|User
     */
    public function update(int $id, array $data): BaseModel|User
    {
        $board = $this->show($id);

        $this->checkIfBoardTaskPrefixIsChangedAndUpdateTaskLabel($data, $board);

        $board->update($data);

        return $this->show($id);
    }

    /**
     * @param array $data
     * @param Board|BaseModel $board
     * @return void
     */
    private function checkIfBoardTaskPrefixIsChangedAndUpdateTaskLabel(array $data, Board|BaseModel $board): void
    {
        if (!Arr::has($data, 'task_prefix')) {
            return;
        }

        if (strcmp($data['task_prefix'], $board->task_prefix) == 0) {
            return;
        }

        UpdateTasksLabelAfterBoardTaskPrefixIsUpdatedJob::dispatch($data['task_prefix'], $board->getKey());
    }
}
