<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Contact;

class UserCanDeleteContactTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserCanDeleteContact()
    {
        $user = factory(User::class)->create();

        $contactOne = factory(Contact::class)->make([
            'name'          => 'userOne',
            'email'         => 'userOne@email.com',
            'mobile_number' => '907596175700',
            'user_id'       => $user->id,
        ]);

        $user->contacts()->save($contactOne);

        $contactTwo = factory(Contact::class)->make([
            'name'          => 'userTwo',
            'email'         => 'userTwo@email.com',
            'mobile_number' => '907596175700',
            'user_id'       => $user->id,
        ]);

        $user->contacts()->save($contactTwo);

        $this->actingAs($user)
            ->visit('/contacts')
            ->press('Delete');

        $contacts = Contact::personalize()->get();
        $this->assertEquals(count($contacts), 1);
    }
}
