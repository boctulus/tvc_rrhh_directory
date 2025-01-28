<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    public function run()
    {
        $positions = [
            'Coordinator of Engineering',
            'Product Engineer',
            // Add other positions from your hardcoded data
        ];

        foreach ($positions as $position) {
            DB::table('positions')->insert([
                'name' => $position,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}