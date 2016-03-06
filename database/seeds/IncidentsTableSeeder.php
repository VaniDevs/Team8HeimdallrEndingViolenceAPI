<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Incident;

class IncidentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Incident::create([
            'uuid' => Uuid::generate(4),
            'user_id' => 1,
            'location' => 'location_1',
            'resolved' => true,
            'created_at' => Carbon::now()
        ]);

        Incident::create([
            'uuid' => Uuid::generate(4),
            'user_id' => 1,
            'location' => 'location_2',
            'resolved' => false,
            'created_at' => Carbon::now()
        ]);

        Incident::create([
            'uuid' => Uuid::generate(4),
            'user_id' => 2,
            'location' => 'location_3',
            'resolved' => true,
            'created_at' => Carbon::now()
        ]);

        Incident::create([
            'uuid' => Uuid::generate(4),
            'user_id' => 2,
            'location' => 'location_4',
            'resolved' => false,
            'created_at' => Carbon::now()
        ]);
    }
}
