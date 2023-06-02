<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Bus\Queueable;
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
     * @param string $taskPrefix
     * @param int $boardId
     */
    public function __construct(public string $taskPrefix, public int $boardId)
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
            ->where('columns.board_id', '=', $this->boardId)
            ->update([
                'tasks.label' => DB::raw("CONCAT('{$this->taskPrefix}-', split_part(tasks.label, '-', 2))")
            ]);
    }
}
