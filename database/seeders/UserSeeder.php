<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create roles first
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'], 
            ['description' => 'Administrator with full access']
        );

        $agentRole = Role::firstOrCreate(
            ['name' => 'agent'], 
            ['description' => 'Agent with limited access']
        );

        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@tvc.com'],
            [
                'name' => 'Admin TVC',
                'password' => Hash::make('TVC#adm_2025!'),
                'role_id' => $adminRole->id
            ]
        );

        // Create agent user
        User::firstOrCreate(
            ['email' => 'agent@tvc.com'],
            [
                'name' => 'Agent TVC',
                'password' => Hash::make('TVC_#Agent_2025!'),
                'role_id' => $agentRole->id
            ]
        );
    }
}