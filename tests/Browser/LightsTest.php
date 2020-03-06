<?php

namespace Tests\Browser;

use App\Light;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LightsTest extends DuskTestCase
{

    use DatabaseMigrations;

    /**
     * @group Lights
     * @throws \Throwable
     */
    public function testLightsIndex()
    {
        $user = factory(User::class)->create(['admin' => true]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/lights')
                ->assertSee('No Lights registered');
        });
    }

    /**
     * @group Lights
     * @throws \Throwable
     */
    public function testLightAdd()
    {
        $user = factory(User::class)->create(['admin' => true]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/lights')
                ->click('@add')
                ->value('#name', 'Light 1')
                ->value('#networkId', '588')
                ->pause(2000)
                ->press('Submit')
                ->pause(2000)
                ->assertSee('Light 1')
                ->assertSee('588')
                ->assertSee("The Light Light 1 has been created.")
                ->assertSee('Unable to connect');
        });
    }

    /**
     * @group Lights
     * @throws \Throwable
     */
    public function testLightEdit()
    {
        $user = factory(User::class)->create(['admin' => true]);
        $light = factory(Light::class)->create();

        $this->browse(function (Browser $browser) use ($user, $light) {
            $browser->loginAs($user)
                ->visit('/lights')
                ->assertSee($light->name)
                ->click("@edit-{$light->id}")
                ->assertRouteIs('lights.edit', $light)
                ->value('#name', 'Test Light')
                ->value('#networkId', '120')
                ->pause(2000)
                ->press('Submit')
                ->assertSee("The Light Test Light has been updated.")
                ->assertSee("120");
        });
    }

    /**
     * @group Lights
     * @throws \Throwable
     */
    public function testLightDelete()
    {
        $user = factory(User::class)->create(['admin' => true]);
        $light = factory(Light::class)->create();

        $this->browse(function (Browser $browser) use ($user, $light) {
            $browser->loginAs($user)
                ->visit('/lights')
                ->assertSee($light->name)
                ->assertSee($light->networkId)
                ->click("@delete-{$light->id}")
                ->pause(2000)
                ->assertSee("The Light {$light->name} has been deleted.")
                ->assertDontSee($light->networkId);
        });
    }
}
