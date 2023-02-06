<?php

namespace Database\Factories;

use App\Enums\UserWorkspaceAccessTypeEnum;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class UserWorkspaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'      => User::factory(),
            'workspace_id' => Workspace::factory(),
            'access_type'  => UserWorkspaceAccessTypeEnum::ADMIN->value,
        ];
    }
}
