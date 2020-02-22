<?php

namespace Tests\Browser;

use App\Group;
use App\Light;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class GroupsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @group Groups
     * @throws \Throwable
     */
    public function testGroupIndex()
    {
        $user = factory(User::class)->create(['admin' => true]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/groups')
                ->assertSee('No Groups registered');
        });

        $group = factory(Group::class)->create();
        $light = factory(Light::class)->create();
        $light2 = factory(Light::class)->create();
        $group->saveLights("{$light->name},{$light2->name}");
        $this->browse(function (Browser $browser) use ($user, $group, $light, $light2) {
            $browser->loginAs($user)
                ->visit('/groups')
                ->assertDontSee('No Groups registered')
                ->assertSee($group->name)
                ->assertSee($light->name)
                ->assertSee($light2->name)
                ->assertSee('On')
                ->assertSee('Off');
        });
    }

    /**
     * @group Groups
     * @throws \Throwable
     */
    public function testGroupDelete()
    {
        $user = factory(User::class)->create(['admin' => true]);
        $group = factory(Group::class)->create();

        $this->browse(function (Browser $browser) use ($user, $group) {
            $browser->loginAs($user)
                ->visit('/groups')
                ->assertSee($group->name)
                ->assertDontSee('On')
                ->assertDontSee('Off')
                ->click("@delete-{$group->id}")
                ->assertDialogOpened("Are you sure you want to delete {$group->name} ?")
                ->acceptDialog()
                ->pause(2000)
                ->assertSee("The Group {$group->name} has been deleted.");
        });
    }

    /**
     * @group Groups
     * @throws \Throwable
     */
    public function testGroupOnOff()
    {
        $user = factory(User::class)->create(['admin' => true]);
        $group = factory(Group::class)->create();

        $light = factory(Light::class)->create();
        $group->saveLights("{$light->name}");

        $this->browse(function (Browser $browser) use ($user, $group, $light) {
            $browser->loginAs($user)
                ->visit('/groups')
                ->assertSee($group->name)
                ->assertSee($light->name)
                ->click("@on-{$group->id}")
                ->pause(2000)
                ->assertSee("Unable to connect the bridge")
                ->click("@off-{$group->id}")
                ->pause(2000)
                ->assertSee("Unable to connect the bridge");
        });
    }
}
