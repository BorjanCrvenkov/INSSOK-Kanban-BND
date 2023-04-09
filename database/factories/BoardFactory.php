<?php

namespace Database\Factories;

use App\Models\Workspace;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class BoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'         => $this->faker->word(),
            'description'  => $this->faker->paragraphs(2, true),
            'workspace_id' => Workspace::factory(),
            'task_prefix'  => strtoupper(Str::random(rand(2,2))),
        ];
    }
}
