<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsSeeder extends Seeder
{
    public function run()
    {
        $skills = [
            ['name' => 'Ingenieria Control de Acceso y Asistencia'],
            ['name' => 'Ingenieria Redes / Ip / Cableado Estructurado / Bosch'],
            ['name' => 'Ingenieria XYZ'],
            // Agrega aquí todas las habilidades únicas del JSON
        ];

        DB::table('skills')->insert($skills);
    }
} 