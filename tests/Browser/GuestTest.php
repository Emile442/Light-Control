<?php

namespace Tests\Browser;

use App\Group;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\GuestIndexPage;
use Tests\DuskTestCase;

class GuestTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testGuestIndexBlank()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit(new GuestIndexPage())
                ->assertSee('Aucun groupe n\'est publique.');
        });
    }

    public function testGuestIndex()
    {
        $user = factory(User::class)->create();
        $group = factory(Group::class)->create([
            'public' => true
        ]);
        $group2 = factory(Group::class)->create();

        $this->browse(function ($browser) use ($user, $group, $group2) {
            $browser->loginAs($user)
                ->visit(new GuestIndexPage())
                ->assertSee(strtoupper($group->name))
                ->assertDontSee(strtoupper($group2->name));
        });
    }

    public function testGuestLaunchTimer()
    {
        $user = factory(User::class)->create();
        $group = factory(Group::class)->create([
            'public' => true
        ]);

        $this->browse(function ($browser) use ($user) {
            $now = Carbon::now()->format('H');
            if (($now >= env('DAY_HOUR')) && ($now < env('NIGHT_HOUR')))
                $browser->loginAs($user)
                    ->visit(new GuestIndexPage())
                    ->assertButtonDisabled('@on-light');
            else
                $browser->loginAs($user)
                    ->visit(new GuestIndexPage())
                    ->click('@on-light')
                    ->assertButtonDisabled('@on-light');
        });
    }
}
