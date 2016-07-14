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

        // Create
        $contact = factory(App\Contact::class, 5)->create();

        $user->contacts()->save($contact);

        $allContacts = App\Contact::all();

        $this->assertEquals(count($allContacts), 5);
    }
}
