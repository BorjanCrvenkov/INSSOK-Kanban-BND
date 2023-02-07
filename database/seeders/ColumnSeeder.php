<?php

namespace Database\Seeders;

use App\Models\Column;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param int $board_id
     * @return Collection|HasFactory|Model|mixed
     */
    public function run(int $board_id)
    {
        return Column::factory(3)->sequence(
            [
                'name'     => 'TO DO',
                'order'    => 1,
                'board_id' => $board_id,
            ],
            [
                'name'     => 'IN PROGRESS',
                'order'    => 2,
                'board_id' => $board_id,
            ],
            [
                'name'     => 'DONE',
                'order'    => 3,
                'board_id' => $board_id,
            ]
        )->create();
    }
}
