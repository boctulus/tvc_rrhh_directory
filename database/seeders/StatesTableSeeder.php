<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['id' => 1, 'name' => 'Aguascalientes', 'abbreviation' => 'AGS'],
            ['id' => 2, 'name' => 'Baja California', 'abbreviation' => 'BC'],
            ['id' => 3, 'name' => 'Baja California Sur', 'abbreviation' => 'BCS'],
            ['id' => 4, 'name' => 'Campeche', 'abbreviation' => 'CAMP'],
            ['id' => 5, 'name' => 'Coahuila', 'abbreviation' => 'COAH'],
            ['id' => 6, 'name' => 'Colima', 'abbreviation' => 'COL'],
            ['id' => 7, 'name' => 'Chiapas', 'abbreviation' => 'CHIS'],
            ['id' => 8, 'name' => 'Chihuahua', 'abbreviation' => 'CHIH'],
            ['id' => 9, 'name' => 'Ciudad de México', 'abbreviation' => 'CDMX'],
            ['id' => 10, 'name' => 'Durango', 'abbreviation' => 'DGO'],
            ['id' => 11, 'name' => 'Guanajuato', 'abbreviation' => 'GTO'],
            ['id' => 12, 'name' => 'Guerrero', 'abbreviation' => 'GRO'],
            ['id' => 13, 'name' => 'Hidalgo', 'abbreviation' => 'HGO'],
            ['id' => 14, 'name' => 'Jalisco', 'abbreviation' => 'JAL'],
            ['id' => 15, 'name' => 'Estado de México', 'abbreviation' => 'MEX'],
            ['id' => 16, 'name' => 'Michoacán', 'abbreviation' => 'MICH'],
            ['id' => 17, 'name' => 'Morelos', 'abbreviation' => 'MOR'],
            ['id' => 18, 'name' => 'Nayarit', 'abbreviation' => 'NAY'],
            ['id' => 19, 'name' => 'Nuevo León', 'abbreviation' => 'NL'],
            ['id' => 20, 'name' => 'Oaxaca', 'abbreviation' => 'OAX'],
            ['id' => 21, 'name' => 'Puebla', 'abbreviation' => 'PUE'],
            ['id' => 22, 'name' => 'Querétaro', 'abbreviation' => 'QRO'],
            ['id' => 23, 'name' => 'Quintana Roo', 'abbreviation' => 'QROO'],
            ['id' => 24, 'name' => 'San Luis Potosí', 'abbreviation' => 'SLP'],
            ['id' => 25, 'name' => 'Sinaloa', 'abbreviation' => 'SIN'],
            ['id' => 26, 'name' => 'Sonora', 'abbreviation' => 'SON'],
            ['id' => 27, 'name' => 'Tabasco', 'abbreviation' => 'TAB'],
            ['id' => 28, 'name' => 'Tamaulipas', 'abbreviation' => 'TAMPS'],
            ['id' => 29, 'name' => 'Tlaxcala', 'abbreviation' => 'TLAX'],
            ['id' => 30, 'name' => 'Veracruz', 'abbreviation' => 'VER'],
            ['id' => 31, 'name' => 'Yucatán', 'abbreviation' => 'YUC'],
            ['id' => 32, 'name' => 'Zacatecas', 'abbreviation' => 'ZAC'],
        ];

        DB::table('states')->insert($states);
    }
}
