<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['name' => 'admin'], ['description' => 'Administrator with full access']);
        Role::firstOrCreate(['name' => 'agent'], ['description' => 'Agent with limited access']);
    }
}