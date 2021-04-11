<?php

namespace Database\Seeders;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\FilmEvent;
use Illuminate\Database\Seeder;

class FilmEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FilmEvent::factory()
            ->count(12)
            ->create();
    }
}
