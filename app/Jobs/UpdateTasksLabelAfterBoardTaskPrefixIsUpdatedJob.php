<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UpdateTasksLabelAfterBoardTaskPrefixIsUpdatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     * @param string $task_prefix
     * @param int $board_id
     */
    public function __construct(public string $task_prefix, public int $board_id)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Task::query()
            ->join('columns', 'tasks.column_id', '=', 'columns.id')
            ->where('columns.board_id', '=', $this->board_id)
            ->update([
                'tasks.label' => DB::raw("CONCAT('{$this->task_prefix}-', split_part(tasks.label, '-', 2))")
            ]);
    }
}
