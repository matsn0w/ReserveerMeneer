<?php

namespace Database\Seeders;

use App\Models\Hall;
use App\Models\Seat;
use App\Models\Cinema;
use Illuminate\Database\Seeder;
use Database\Seeders\HallSeeder;

class CinemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 4 cinema's with 3 halls each
        Cinema::factory()
            ->count(4)
            ->has(Hall::factory()->count(3))
            ->create();

        // loop through all halls
        foreach (Hall::all() as $hall) {
            $seats = [];

            // build seats for each row
            for ($row = 1; $row <= $hall->rows; $row++) {
                for ($number = 1; $number <= $hall->seatsPerRow; $number++) {
                    $seat = Seat::factory()
                        ->state([
                            'hall_id' => $hall->id,
                            'row' => $row,
                            'number' => $number
                        ])
                        ->create();

                    array_push($seats, $seat);
                }
            }

            // assign the seats to the hall
            $hall->seats = $seats;
        }
    }
}
