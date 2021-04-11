<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EventReservationTest extends DuskTestCase
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
     * Tests if a user is abled to make a reservation for an event.
     *
     * @group events
     * @return void
     */
    public function test_user_can_reserve_event()
    {
        User::factory([
            'name' => 'Teddie',
            'email' => 'teddie@hotmail.nl',
        ])->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visitRoute('events.show', 1)
                    ->assertSee('Reserveren')
                    ->clickLink('Reserveren')
                    ->type('postal_code', '1234AB')
                    ->type('street_name', 'Teststraat')
                    ->type('house_number', '4b')
                    ->type('city', 'Teststad')
                    ->type('country', 'Testland')
                    ->type('date', '01-01-2022')
                    ->type('time', '20:00')
                    ->select('tickettype', '1')
                    ->type('ticketamount', '2')
                    ->press('Volgende')
                    ->assertSee('Gast #1')
                    ->assertSee('Gast #2')
                    ->type('guests[0][name]', 'Hans')
                    ->type('guests[0][birthdate]', '25-10-2000')
                    ->type('guests[1][name]', 'Piet')
                    ->type('guests[1][birthdate]', '30-04-2002')
                    ->press('Volgende')
                    ->assertSee('Reservering is opgeslagen!');
        });
    }
}
