<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanRegisterTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test users ability to register
     *
     * @return void
     */
    public function testUserCanRegister()
    {
        // Create a new User
        factory(App\User::class)->create([
            'name'     => 'userOne',
            'email'    => 'userOne@email.com',
            'password' => bcrypt('password'),
        ]);

        // See the newlycreated user in the database
        $this->seeInDatabase('users', ['name' => 'userOne']);

        // Create another new User
        factory(App\User::class)->create([
            'name'     => 'userOne',
            'email'    => 'userOne@email.com',
            'password' => bcrypt('password'),
        ]);

        $allUsers = App\User::all();

        $this->assertEquals(count($allUsers), 2);
    }
}
