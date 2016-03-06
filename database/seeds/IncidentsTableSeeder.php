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
            'location' => '-149,27',
            'resolved' => true,
            'created_at' => Carbon::now()
        ]);

        Incident::create([
            'uuid' => Uuid::generate(4),
            'user_id' => 1,
            'location' => '-149,27',
            'resolved' => false,
            'created_at' => Carbon::now()
        ]);

        Incident::create([
            'uuid' => Uuid::generate(4),
            'user_id' => 2,
            'location' => '-149,27',
            'resolved' => true,
            'created_at' => Carbon::now()
        ]);

        Incident::create([
            'uuid' => Uuid::generate(4),
            'user_id' => 2,
            'location' => '-149,27',
            'resolved' => false,
            'created_at' => Carbon::now()
        ]);
    }
}
