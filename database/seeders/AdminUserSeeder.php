<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@tvc.com'],
            [
                'name' => 'Admin TVC',
                'password' => Hash::make('TVC#adm_2025!'),
            ]
        );
    }
}