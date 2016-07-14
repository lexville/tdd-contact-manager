<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Contact;

class UserCanSeeIndividualContactTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserCanSeeaIndividualContacts()
    {
        $user = factory(User::class)->create();

        $contactOne = factory(Contact::class)->make([
            'name'          => 'userOne',
            'email'         => 'userOne@email.com',
            'mobile_number' => '0953834981691',
            'user_id'       => $user->id
        ]);

        $user->contacts()->save($contactOne);

        $contactOne = factory(Contact::class)->make([
            'name'          => 'userTwo',
            'email'         => 'userTwo@email.com',
            'mobile_number' => '907596175700',
            'user_id'       => $user->id,
        ]);

        $this->actingAs($user)
            ->call(
                'GET',
                '/contacts/1'
            );
        $this->assertNotEquals(
            'userTwo',
            Contact::findOrFail(1)['name']
        );
        $this->assertEquals(
            'userOne',
            Contact::findOrFail(1)['name']
        );

        $this->actingAs($user)
            ->visit('/contacts/1')
            ->see('userOne', 'name')
            ->visit('/contacts/2')
            ->see('userTwo', 'name');
    }
}
