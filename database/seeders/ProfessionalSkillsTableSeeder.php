<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionalSkillsTableSeeder extends Seeder
{
    public function run()
    {
        $professionalSkills = [
            [
                'professional_id' => 1,
                'skill_id' => 1,
                'expertise_level' => 5, // Ajusta según el nivel de experiencia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Agrega aquí todas las relaciones profesional-habilidad del JSON
        ];

        DB::table('professional_skill')->insert($professionalSkills);
    }
} 