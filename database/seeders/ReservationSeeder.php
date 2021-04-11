<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use App\Models\Event;
use App\Models\EventGuest;
use App\Models\EventReservation;
use App\Models\File;
use App\Models\FilmEvent;
use App\Models\FilmEventReservation;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\RestaurantReservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reservation::factory()->count(1)
        //     ->has(EventReservation::factory()->count(4)
        //         ->has(Event::factory()
        //             ->has(EventGuest::factory()->count(5))
        //         )
        //     )
        //     ->has(Address::factory()->count(1))
        //     ->has(User::factory()->count(1))
        // ->create();


        $this->user = User::factory()->create();
        $this->address = Address::factory()->create();


        Reservation::factory()->count(4)->create([
            'user_id' => $this->user->id, 
            'address_id' => $this->address->id,
            'related_id' => function() {
                $eventreservation = EventReservation::factory()->create([
                    'event_id' => Event::factory()->create()->id,
                ]);
                $eventreservation->guests()->saveMany(EventGuest::factory()->count(5)->create([
                    'event_reservation_id' => $eventreservation->id,
                    'file_id' => File::factory()->create([
                        'user_id' => $this->user->id,
                    ])->id 
                ]));
                return $eventreservation->id;
            },
            'related_type' => 'App\Models\EventReservation',
        ]);

        Reservation::factory()->count(4)->create([
            'user_id' => $this->user->id, 
            'address_id' => $this->address->id,
            'related_id' => function() {
                $restaurantreservation = RestaurantReservation::factory()->create([
                    'restaurant_id' => Restaurant::factory()->create()->id,
                ]);

                return $restaurantreservation->id;
            },
            'related_type' => 'App\Models\RestaurantReservation',
        ]);

        Reservation::factory()->count(4)->create([
            'user_id' => $this->user->id, 
            'address_id' => $this->address->id,
            'related_id' => function() {
                $filmeventreservation = FilmEventReservation::factory()->create([
                    'filmevent_id' => FilmEvent::factory()->create()->id,
                ]);

                return $filmeventreservation->id;
            },
            'related_type' => 'App\Models\FilmEventReservation',
        ]);



        foreach(FilmEventReservation::all() as $filmreservation) {
            $this->filmevent = $filmreservation->filmevent;
            $hall = $this->filmevent->hall;
            $seats = $hall->seats;

            $seat = $seats->random();
            $filmreservation->seats()->save($seat);
        }
    }
}
