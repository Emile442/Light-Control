<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testLoginPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Connexion');
        });
    }

    public function testLoginRedirectAlreadyAuth()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/login')
                ->assertPathIs('/guest');
        });
    }
}
