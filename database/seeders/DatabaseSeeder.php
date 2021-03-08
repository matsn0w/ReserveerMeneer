<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\MovieSeeder;
use Database\Seeders\CinemaSeeder;
use Database\Seeders\FilmEventSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CinemaSeeder::class);
        $this->call(MovieSeeder::class);
        $this->call(FilmEventSeeder::class);
        $this->call(EventSeeder::class);
    }
}
