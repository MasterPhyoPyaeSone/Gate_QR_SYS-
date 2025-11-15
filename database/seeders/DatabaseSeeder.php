<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'username' => 'Admin',
            'password' => Hash::make('admin2025'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'security',
            'password' => Hash::make('security2025'),
            'role' => 'security',
        ]);
    }
}
