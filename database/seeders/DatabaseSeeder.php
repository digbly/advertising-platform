<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin@gmail.com',
            'role' => User::ROLE_ADMIN,
            'is_super_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@gmail.com',
            'password' => 'demo@gmail',
            'role' => User::ROLE_USER,
        ]);
    }
}
