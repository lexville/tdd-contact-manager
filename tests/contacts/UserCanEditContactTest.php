<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Contact;

class UserCanEditContactTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test logged in users can add contact
     *
     * @return void
     */
    public function testUserCanEditContactTest()
    {
        // Create a new user
        $user = factory(App\User::class)->create();

        // Create contacts
        $contacts = factory(App\Contact::class, 5)->create();

        $anotherContact = factory(App\Contact::class)->make([
            'name'          => 'anotherUser',
            'email'         => 'anotherUser@email.com',
            'mobile_number' => '12345678',
            'user_id'       => $user->id
        ]);
        $user->contacts()->save($anotherContact);

        $this->actingAs($user)
            ->call(
                'PUT',
                '/contacts/' . $anotherContact->id,
                [
                    'name' => 'theNewlyEditedUser',
                    'email' =>  $anotherContact->email,
                    'mobile_number' =>  $anotherContact->mobile_number,
                ]
            );
        $this->assertEquals(
            'theNewlyEditedUser',
            Contact::findOrFail($anotherContact->id)['name']
        );
    }
}
