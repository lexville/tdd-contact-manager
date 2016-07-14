<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Contact;

class UserCanSeeCreatedContactTest extends TestCase
{
    use DatabaseMigrations;
    
    public function testUserCanSeeContacts()
    {
        $user = factory(User::class)->create();

        $contacts = factory(Contact::class, 5)->create();

        $user->contacts()->saveMany($contacts);

        $userContacts = Contact::personalize()->get();

        $this->assertEquals(count($userContacts), 5);
    }
}
