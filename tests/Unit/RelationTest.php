<?php

namespace Tests\Unit;

use App\Models\Event;
use PHPUnit\Framework\TestCase;
use App\Models\FilmEventReservation;
use App\Models\RestaurantReservation;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RelationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testPolyReservations()
    {
        $this->seed();

        $restaurantreservation = RestaurantReservation::first();
        $eventreservation = Event::first();
        $filmeventreservation = FilmEventReservation::first();

        if(get_class($restaurantreservation->related->getRelated()) == Reservation::class) {
            if(get_class($eventreservation->related->getRelated()) == Reservation::class) {
                if(get_class($filmeventreservation->related->getRelated()) == Reservation::class) {
                    $this->assertTrue(true);
                }
            }
        }

        $this->assertTrue(false);       
    }
}
