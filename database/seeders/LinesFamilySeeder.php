<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinesFamilySeeder extends Seeder
{
    public function run()
    {
        $families = [
            ['name' => 'dahua_cameras'],
            ['name' => 'dahua_ip'],
            ['name' => 'dahua_dvrs'],
            ['name' => 'dahua_accessories'],
            ['name' => 'dahua_access'],
            ['name' => 'dahua_videoporteros'],
            ['name' => 'dahua_networks'],
            ['name' => 'dahua_alarms'],
            ['name' => 'dahua_signage'],
            ['name' => 'ubiquiti_unifi'],
            ['name' => 'ubiquiti_airmax'],
            ['name' => 'draytek'],
            ['name' => 'tp_link_omada'],
        ];

        DB::table('lines_families')->insert($families);
    }
} 