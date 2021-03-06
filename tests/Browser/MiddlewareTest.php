<?php

namespace Tests\Browser;

use App\Group;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\GuestIndexPage;
use Tests\DuskTestCase;

class MiddlewareTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @group Middleware
     * @throws \Throwable
     */
    public function testMiddlewareAdmin()
    {
        $user = factory(User::class)->create(['admin' => true]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/')
                ->assertDontSee('Aucun groupe n\'est publique.')
                ->assertSee('No timer is running at the moment.')
                ->assertRouteIs('root')
                ->visit('/lights')
                ->assertSee('All lights')
                ->assertRouteIs('lights.index');
        });
    }

    /**
     * @group Middleware
     * @throws \Throwable
     */
    public function testMiddlewareAdminSuspend()
    {
        $user = factory(User::class)->create(['admin' => true, 'suspend' => true]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/guest')
                ->assertSee('Votre compte a été suspendu, merci de prendre avec l\'ADM')
                ->assertRouteIs('guest')
                ->visit('/lights')
                ->assertSee('403');
        });
    }

    /**
     * @group Middleware
     * @throws \Throwable
     */
    public function testMiddlewareUser()
    {
        $user = factory(User::class)->create();
        $group = factory(Group::class)->create(['public' => true]);

        $this->browse(function ($browser) use ($user, $group) {
            $browser->loginAs($user)
                ->visit('/')
                ->assertSee('403')
                ->visit('/guest')
                ->pause(2000)
                ->assertSee(strtoupper($group->name))
                ->assertDontSee('Votre compte a été suspendu, merci de prendre avec l\'ADM')
                ->assertRouteIs('guest')
                ->visit('/lights')
                ->pause(2000)
                ->assertSee('403')
                ->assertRouteIs('lights.index');
        });
    }

    /**
     * @group Middleware
     * @throws \Throwable
     */
    public function testMiddlewareUserSuspend()
    {
        $user = factory(User::class)->create(['suspend' => true]);
        $group = factory(Group::class)->create(['public' => true]);

        $this->browse(function ($browser) use ($user, $group) {
            $browser->loginAs($user)
                ->visit('/')
                ->assertSee('403')
                ->visit('/guest')
                ->pause(2000)
                ->assertDontSee(strtoupper($group->name))
                ->assertSee('Votre compte a été suspendu, merci de prendre avec l\'ADM')
                ->assertRouteIs('guest');
        });
    }

    /**
     * @group Middleware
     * @throws \Throwable
     */
    public function testMiddlewareGuest()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                ->assertSee('Connexion')
                ->assertRouteIs('login');
        });
    }

}
