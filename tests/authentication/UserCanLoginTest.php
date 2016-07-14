<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanLoginTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test users ability to login
     *
     * @return void
     */
    public function testUserCanLogin()
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
            ->see('userOne');
    }
}
