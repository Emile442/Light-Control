<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    // use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHomeRedirectTest()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
    }
}
