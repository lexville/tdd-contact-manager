<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OnlyLoggedinUsersSeeInfoTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test what logged out users see
     *
     * @return void
     */
    public function testLoggedInUserCanSee()
    {

        factory(App\User::class)->create([
            'name'     => 'userOne',
            'email'    => 'userOne@email.com',
            'password' => bcrypt('password'),
        ]);

        $this->visit('/login')
            ->type('userOne@email.com', 'email')
            ->type('password', 'password')
            ->press('Login')
            ->see('Logout')
            ->dontsee('Login')
            ->dontsee('Register');
    }
}
