<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanAddContactTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test logged in users can add contact
     *
     * @return void
     */
    public function testUserCanCreateContact()
    {
        // Create a new user
        $user = factory(App\User::class)->create();

        // Create contacts
        $contacts = factory(App\Contact::class, 5)->create();

        $user->contacts()->saveMany($contacts);

        $allContacts = App\Contact::all();

        $this->assertEquals(count($allContacts), 5);
    }

    public function testOnlyLoggedinUsersCanCreateContact()
    {
        $this->visit('/contacts/create')
            ->seePageIs('/login');
    }

    public function testLoggedinUsersCanCreateContact()
    {
        // create user
        $user = factory(App\User::class, 1)->create();

        $this->actingAs($user)
            ->visit('/contacts/create')
            ->seePageIs('/contacts/create');
    }
}
