<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'uuid' => Uuid::generate(4),
            'first_name' => 'Victor',
            'last_name' => 'Smith',
            'email' => 'user@user.com',
            'address' => '4298 Water Street Surrey, BC, M5H 1P6',
            'photo' => str_random(20),
            'password' => bcrypt('secret'),
            'api_token' => 'aav6Mp28xEWBDDuuCxxG3nhuAXQFiMT2rexEOcMqLnefP31fEPH2GnHISsQK',
            'phone' => '604-555-5555',
            'is_admin' => false
        ]);

        User::create([
            'uuid' => Uuid::generate(4),
            'first_name' => 'Wade',
            'last_name' => 'McBride',
            'email' => 'user2@user.com',
            'address' => '383 Adelaide St Vancouver, BC, J3P 4M9',
            'photo' => str_random(20),
            'password' => bcrypt('secret'),
            'api_token' => 'qiv6Mp28xEWBDDuuCxxG3nhuAXQFiMT2rexMOcMqLnefP31fEPH2GnHISsXp',
            'phone' => '604-888-888',
            'is_admin' => true
        ]);
    }
}
