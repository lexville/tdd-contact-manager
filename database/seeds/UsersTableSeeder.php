<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 12)->create();

        factory(App\User::class)->create([
            'name'     => 'userOne',
            'email'    => 'userOne@email.com',
            'password' => bcrypt('password'),
        ]);
    }
}
