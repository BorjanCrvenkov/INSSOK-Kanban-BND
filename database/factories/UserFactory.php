<?php

namespace Database\Factories;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'image_name' => $this->faker->word(),
            'image_link' => $this->faker->imageUrl(),
            'remember_token' => Str::random(10),
            'role_id' => Role::query()->where('name', '=', RoleEnum::USER->value)->first()->getKey(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     *
     * @return static
     */
    public function admin(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::query()->where('name', '=', RoleEnum::ADMINISTRATOR->value)->first()->getKey(),
            ];
        });
    }
}
