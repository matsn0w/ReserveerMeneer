<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Cinema;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::factory()
            ->count(16)
            ->create();

        // get all the cinemas, attaching up to 3 random cinemas to each movie
        $cinemas = Cinema::all();

        // populate cinema_movie pivot table
        Movie::all()->each(function ($movie) use ($cinemas) {
            $movie->cinemas()->attach(
                $cinemas->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
