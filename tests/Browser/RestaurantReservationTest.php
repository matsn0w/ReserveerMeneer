<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RestaurantReservationTest extends DuskTestCase
{
    protected static $migrationRun = false;

    public function setUp(): void{
        parent::setUp();

        if (!static::$migrationRun){
            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');
            static::$migrationRun = true;
        }
    }

    /**
     * Tests if a user is abled to make a reservation for a restaurant.
     *
     * @group restaurants
     * @return void
     */
    public function test_user_can_reserve_restaurant()
    {
        User::factory([
            'name' => 'Teddie',
            'email' => 'teddie@hotmail.nl',
        ])->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visitRoute('restaurants.show', 1)
                    ->assertSee('Reserveren')
                    ->clickLink('Reserveren')
                    ->type('postal_code', '1234AB')
                    ->type('street_name', 'Teststraat')
                    ->type('house_number', '4b')
                    ->type('city', 'Teststad')
                    ->type('country', 'Testland')
                    ->type('date', '01-01-2022')
                    ->type('time', '20:00')
                    ->type('groupsize', 3)
                    ->press('Plaats reservering')
                    ->assertSee('Reservering is opgeslagen!');
        });
    }
}
