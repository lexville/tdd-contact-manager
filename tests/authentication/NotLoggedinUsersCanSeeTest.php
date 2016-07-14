<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotLoggedinUsersCanSeeTest extends TestCase
{
    /**
     * Test what non logged users see
     *
     * @return void
     */
    public function testNotLoggedInUserCanSee()
    {
        $this->visit('/')
            ->see('Login')
            ->see('Register');
    }
}
