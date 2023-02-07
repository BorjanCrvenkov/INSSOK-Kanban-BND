<?php

namespace Database\Seeders;

use App\Models\UserTaskComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTaskCommentSeeder extends Seeder
{
    /**
     * @param WatchesSeeder $watches_seeder
     */
    public function __construct(public WatchesSeeder $watches_seeder)
    {
    }

    /**
     * Run the database seeds.
     *
     * @param int $user_id
     * @param int $task_id
     * @return void
     */
    public function run(int $user_id, int $task_id): void
    {
        UserTaskComment::factory()->create([
            'user_id' => $user_id,
            'task_id' => $task_id,
        ]);

        $this->watches_seeder->run($user_id, $task_id);
    }
}
