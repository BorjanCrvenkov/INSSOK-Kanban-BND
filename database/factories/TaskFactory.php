<?php

namespace Database\Factories;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskTypeEnum;
use App\Models\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'       => $this->faker->word(),
            'description' => $this->faker->paragraphs(2, true),
            'priority'    => $this->faker->randomElement(TaskPriorityEnum::getAllValuesAsArray()),
            'due_date'    => $this->faker->dateTimeThisYear,
            'type'        => $this->faker->randomElement(TaskTypeEnum::getAllValuesAsArray()),
            'order'       => $this->faker->randomNumber(),
            'column_id'   => Column::factory(),
            'reporter_id' => User::factory(),
            'assignee_id' => User::factory(),
            'label'       => Str::random(3) . '-' . $this->faker->numberBetween(1, 10000),
        ];
    }
}
