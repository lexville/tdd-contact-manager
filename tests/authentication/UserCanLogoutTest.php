<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanLogoutTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test users ability to logout
     *
     * @return void
     */
    public function testUserCanLogout()
    {
        // Create a new user
        factory(App\User::class)->create([
            'name'     => 'userOne',
            'email'    => 'userOne@email.com',
            'password' => bcrypt('password'),
        ]);

        $this->visit('/login')
            ->type('userOne@email.com', 'email')
            ->type('password', 'password')
            ->press('Login')
            ->see('userOne');

        $this->visit('/logout')
            ->see('Login')
            ->see('Register');
    }
}
