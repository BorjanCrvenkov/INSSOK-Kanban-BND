<?php

namespace Database\Seeders;

use App\Models\Task;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param int $column_id
     * @param $users
     * @return array
     * @throws Exception
     */
    public function run(int $column_id, $users)
    {
        $random_tasks = random_int(5, 10);
        $tasks = [];
        for ($i = 0; $i < $random_tasks; $i++) {
            $reporter_id = $users->random()->getKey();
            $assignee_id = $users->random()->getKey();

            $tasks[] = Task::factory()->create([
                'column_id'   => $column_id,
                'reporter_id' => $reporter_id,
                'assignee_id' => $assignee_id,
            ]);
        }

        return $tasks;
    }
}
