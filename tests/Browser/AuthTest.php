<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Tests if a user is abled to log in.
     *
     * @return void
     */
    public function test_login()
    {
        $user = User::factory()->create([
            'email' => 'test@laravel.dusk',
            'password' => Hash::make('Password123!'),
            'phonenumber' => '1234'
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visitRoute('login')
                ->type('email', $user->email)
                ->type('password', 'Password123!')
                ->press('Inloggen')
                ->assertPathIs('/');
        });
    }

    /**
     * Tests if a user is abled to log out.
     *
     * @return void
     */
    public function test_logout()
    {
        $this->browse(function (Browser $browser) {
            $browser->assertSee('Log uit')
                ->clickLink('Log uit')
                ->assertPathIs('/');
        });
    }
}
