<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use App\Models\Event;
use App\Models\EventGuest;
use App\Models\EventReservation;
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


        $user = User::factory()->count(1)->create();
        $address = Address::factory(1)->count(1)->create();

        Reservation::factory()->count(4)->create(['user_id' => $user->id, 'address_id' => $address->id])->each(function ($reservation) {
            //create 5 posts for each user
            $reservation->related->save(EventReservation::factory()->create()->each(function ($eventreservation) {
                $eventreservation->event->save(Event::factory()->create());
                $eventreservation->guests->saveMany(EventGuest::factory()->count(5)->create());
            }));
        });

        // Reservation::factory()->count(1)
        //     ->has(RestaurantReservation::factory()->count(4)
        //         ->has(Restaurant::factory())
        //     )
        //     ->has(Address::factory())
        //     ->has(User::factory())
        // ->create();

        // Reservation::factory()->count(1)
        //     ->has(FilmEventReservation::factory()->count(1)
        //         ->has(FilmEvent::all()->random())
        //     )
        //     ->has(Address::factory()->count(1))
        //     ->has(User::factory()->count(1))
        // ->create();

        // foreach(FilmEventReservation::all() as $filmreservation) {
        //     $this->filmevent = $filmreservation->filmevent;
        //     $hall = $this->filmevent->hall;
        //     $this->reservedseats = $hall->seats->filmeventreservations->filter(function($r) { return $r->filmevent_id == $this->filmevent->id;});
        //     $seats = $hall->seats->filter(function($r) { return !$this->reservedseats->contains($r);});

        //     $seat = $seats->random();
        //     $filmreservation->seats->save($seat);
        // }
    }
}
