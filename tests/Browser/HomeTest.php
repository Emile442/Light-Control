<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class HomeTest extends DuskTestCase
{
    public function testHomeRedirect()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')->waitForRoute('login')->assertSee('Connexion');
        });
    }
}
