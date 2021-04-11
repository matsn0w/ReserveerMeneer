<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;

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
     * Tests if a user is abled to register.
     *
     * @group auth
     * @return void
     */
    public function test_register()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('register')
                ->type('name', 'Tedje Test')
                ->type('email', 'tedje@test.com')
                ->type('phonenumber', '31612345678')
                ->type('password', 'Password123!')
                ->type('password_confirmation', 'Password123!')
                ->press('Registreer')
                ->assertPathIs('/')
                ->assertSee('Je bent ingelogd als Tedje Test')
                ->logout();
        });
    }

    /**
     * Tests if a user is abled to log in.
     *
     * @group auth
     * @return void
     */
    public function test_login()
    {
        $user = User::factory([
            'name' => 'Teddie',
            'email' => 'teddie@hotmail.nl',
        ])->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visitRoute('login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('Inloggen')
                ->assertPathIs('/');
        });
    }

    /**
     * Tests if a user is abled to log out.
     *
     * @group auth
     * @return void
     */
    public function test_logout()
    {
        User::factory([
            'name' => 'Teddie',
            'email' => 'teddie@hotmail.nl',
        ])->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visitRoute('home')
                ->assertSee('Log uit')
                ->clickLink('Log uit')
                ->assertPathIs('/');
        });
    }

    /**
     * Tests if a user is denied to see all movies.
     *
     * @group auth
     * @return void
     */
    public function test_access_denied()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('movies.index')
                ->assertSee('403')
                ->assertPathIs('/movies');
        });
    }

    /**
     * Tests if a user is allowed to see all film events.
     *
     * @group auth
     * @return void
     */
    public function test_access_granted()
    {
        User::factory([
            'name' => 'Teddie',
            'email' => 'teddie@hotmail.nl',
        ])->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visitRoute('filmevents.index')
                ->assertSee('Filmavonden')
                ->assertPathIs('/filmevents');
        });
    }
}
