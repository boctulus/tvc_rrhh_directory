<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('certifications')->insert([
            ['id' => 1, 'name' => 'Access Zkteco (Security inspection line series ZKD, ZKX5000, ZKX6500, ZKX10080) video surveillance DHCA-VIS DHSA DHCA-ACS Transmission + DoLink Care'],
            ['id' => 2, 'name' => 'Certifications in DHCA-VIS DHSA DHCA-ACS'],
            ['id' => 3, 'name' => 'Certifications in Transmission + DoLink Care DHSA DHCA-ACS']            
        ]);
    }
}
