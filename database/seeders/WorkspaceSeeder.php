<?php

namespace Database\Seeders;

use App\Enums\UserWorkspaceAccessTypeEnum;
use App\Models\Board;
use App\Models\Column;
use App\Models\Task;
use App\Models\User;
use App\Models\UserTaskComment;
use App\Models\UserWorkspace;
use App\Models\Workspace;
use Database\Factories\UserWorkspaceFactory;
use Exception;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkspaceSeeder extends Seeder
{
    /**
     * @param ColumnSeeder $column_seeder
     * @param TaskSeeder $task_seeder
     * @param UserTaskCommentSeeder $user_task_comment_seeder
     */
    public function __construct(public ColumnSeeder          $column_seeder, public TaskSeeder $task_seeder,
                                public UserTaskCommentSeeder $user_task_comment_seeder)
    {
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        $workspaces = Workspace::factory(random_int(4, 8))->create();

        foreach ($workspaces as $workspace) {
            $workspace_id = $workspace->getKey();
            $this->generateUsersAndAccessToWorkspace($workspace_id);

            $boards = Board::factory(random_int(1, 3))->create([
                'workspace_id' => $workspace_id,
            ]);

            foreach ($boards as $board) {
                $board_id = $board->getKey();
                $columns = $this->column_seeder->run($board_id);

                foreach ($columns as $column) {
                    $column_id = $column->getKey();
                    $tasks = $this->task_seeder->run($column_id, $workspace->users);

                    foreach ($tasks as $task) {
                        $reporter_id = $workspace->users->random()->getKey();
                        $this->user_task_comment_seeder->run($reporter_id, $task->getKey());

                        $assignee_id = $workspace->users->random()->getKey();
                        $this->user_task_comment_seeder->run($assignee_id, $task->getKey());
                    }
                }
            }
        }
    }

    /**
     * @param int $workspace_id
     * @return void
     * @throws Exception
     */
    private function generateUsersAndAccessToWorkspace(int $workspace_id): void
    {
        $faker = Factory::create();
        $user = User::factory()->create();

        UserWorkspace::factory()->create([
            'user_id'      => $user->getKey(),
            'workspace_id' => $workspace_id,
            'access_type'  => UserWorkspaceAccessTypeEnum::ADMIN->value,
        ]);

        $users = User::factory(random_int(4, 10))->create();

        foreach ($users as $user) {
            $bool = $faker->boolean();

            UserWorkspace::factory()->create([
                'user_id'      => $user->getKey(),
                'workspace_id' => $workspace_id,
                'access_type'  => $bool ? UserWorkspaceAccessTypeEnum::MANAGER->value : UserWorkspaceAccessTypeEnum::USER->value,
            ]);
        }
    }
}
