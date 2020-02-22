<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @group Users
     * @throws \Throwable
     */
    public function testUsersIndex()
    {
        $user = factory(User::class)->create(['admin' => true]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/users')
                ->assertSee($user->name)
                ->assertSee($user->email);
        });
    }

    /**
     * @group Users
     * @throws \Throwable
     */
    public function testUsersIndexPaginate()
    {
        $users = factory(User::class, 150)->create();
        $user = factory(User::class)->create(['admin' => true]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/users')
                ->assertSee($user->name)
                ->assertSee($user->email)
                ->assertSee('3');
        });
    }

    /**
     * @group Users
     * @throws \Throwable
     */
    public function testUsersEdit()
    {
        $users = factory(User::class, 150)->create();
        $user = factory(User::class)->create(['admin' => true]);

        $this->browse(function (Browser $browser) use ($user, $users) {
            $browser->loginAs($user)
                ->visit('/users')
                ->click("@edit-{$users[145]->id}")
                ->assertRouteIs('users.edit', $users[145])
                ->value('#name', 'Epitech')
                ->value('#email', 'emile.lepetit@epitech.eu')
                ->select('#admin', '0')
                ->select('#suspend', '1')
                ->press('Submit')
                ->assertSee("Epitech has been edited.");

            $this->assertTrue($browser->value('#name') == 'Epitech');
            $this->assertTrue($browser->value('#email') == 'emile.lepetit@epitech.eu');
            $this->assertTrue($browser->value('#admin') == '0');
            $this->assertTrue($browser->value('#suspend') == '1');
        });
    }

    /**
     * @group Users
     * @throws \Throwable
     */
    public function testUsersDelete()
    {
        $users = factory(User::class, 15)->create();
        $user = factory(User::class)->create(['admin' => true]);

        $this->browse(function (Browser $browser) use ($user, $users) {
            $browser->loginAs($user)
                ->visit('/users')
                ->assertSee($users[13]->name)
                ->assertSee($users[13]->email)
                ->click("@delete-{$users[13]->id}")
                ->assertDialogOpened("Are you sure to want to delete {$users[13]->name} ?")
                ->acceptDialog()
                ->pause(2000)
                ->assertSee("{$users[13]->name} has been created.")
                ->assertDontSee($users[13]->email);
        });
    }
}
