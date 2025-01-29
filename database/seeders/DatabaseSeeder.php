<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // $this->call([
        //     StatesSeeder::class,
        //     LocationSeeder::class,
        //     LinesFamilySeeder::class,
        //     AreaSeeder::class,
        //     PositionSeeder::class,
        //     BrandSeeder::class,
        //     CertificationSeeder::class,
        //     ProfessionalsSeeder::class,
        //     SkillsSeeder::class,
        //     ProfessionalSkillsSeeder::class,            
        // ]);

        $this->run_all();
    }

    private function run_all()
    {
        // Obtener archivos de la carpeta de seeders
        $seederFiles = glob(__DIR__ . '/*.php');
        $seeders = [];

        foreach ($seederFiles as $file) {
            $className = basename($file, '.php');

            // Evitar incluir DatabaseSeeder para evitar recursión
            if ($className !== 'DatabaseSeeder') {
                $namespaceClass = __NAMESPACE__ . '\\' . $className;
                if (class_exists($namespaceClass)) {
                    $seeders[] = $namespaceClass;
                }
            }
        }

        // Ejecutar los seeders dinámicamente
        $this->call($seeders);
    }
}
