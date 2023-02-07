<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

        Role::factory()->create([
            'name' => RoleEnum::ADMINISTRATOR->value,
        ]);

        Role::factory()->create([
            'name' => RoleEnum::USER->value,
        ]);

    }
}
