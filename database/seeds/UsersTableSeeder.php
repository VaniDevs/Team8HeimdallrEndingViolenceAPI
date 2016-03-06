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
        DB::table('users')->insert([
            'uuid' => Uuid::generate(4),
            'first_name' => str_random(10),
            'last_name' => str_random(10),
            'email' => 'user@user.com',
            'address' => str_random(10),
            'photo' => str_random(10),
            'password' => bcrypt('secret'),
            'api_token' => str_random(60),
            'phone' => '604-555-5555'
        ]);
    }
}
