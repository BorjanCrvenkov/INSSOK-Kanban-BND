<?php

namespace Database\Seeders;

use App\Models\Watches;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WatchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param int $user_id
     * @param int $task_id
     * @return void
     */
    public function run(int $user_id, int $task_id): void
    {
        $exists = Watches::query()->where('user_id', '=', $user_id)
            ->where('task_id', '=', $task_id)
            ->exists();

        if($exists){
            return;
        }

        Watches::factory()->create([
            'user_id' => $user_id,
            'task_id' => $task_id,
        ]);
    }
}
