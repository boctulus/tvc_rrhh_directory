<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            ['id' => 1, 'name' => 'MTY'],
            ['id' => 2, 'name' => 'CDMX'],
        ];

        DB::table('locations')->insert($locations);
    }
}
