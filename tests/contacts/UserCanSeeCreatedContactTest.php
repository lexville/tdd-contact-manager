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

        $contacts = factory(Contact::class, 5)->make();

        $user->contacts()->saveMany($contacts);

        $userContacts = Contact::personalize()->get();

        $this->assertEquals(count($userContacts), 5);
    }

    public function testUserCanOnlySeeTheirContacts()
    {
        $userOne = factory(User::class)->create();

        $userOneContacts = factory(Contact::class, 5)->make();

        $userOne->contacts()->saveMany($userOneContacts);

        $userOneContacts = Contact::where('user_id', $userOne->id)->get();

        $this->assertEquals(count($userOneContacts), 5);

        $userTwo = factory(User::class)->create();

        $userTwoContacts = factory(Contact::class, 30)->make();

        $userTwo->contacts()->saveMany($userTwoContacts);

        $userTwoContacts = Contact::where('user_id', $userTwo->id)->get();

        $this->assertEquals(count($userTwoContacts), 30);
    }
}
