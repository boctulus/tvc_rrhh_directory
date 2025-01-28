<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    public function run()
    {
        $areas = [
            ['name' => 'Ingenieria Control de Acceso y Asistencia'],
            ['name' => 'Ingenieria Redes / Ip / Cableado Estructurado / Bosch'],
            ['name' => 'Ingenieria XYZ'],
        ];

        DB::table('areas')->insert($areas);
    }
} 