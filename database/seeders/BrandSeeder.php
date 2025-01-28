<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            ['name' => 'Dahua'],
            ['name' => 'Draytek'],
            ['name' => 'Tp-Link'],
            ['name' => 'Ubiquiti'],
        ];

        DB::table('brands')->insert($brands);
    }
} 