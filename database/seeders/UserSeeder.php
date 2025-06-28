<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate([
            'email' => 'admin@pesantren.com'
        ], [
            'name' => 'Administrator',
            'email' => 'admin@pesantren.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);

        // Create additional users for testing
        User::updateOrCreate([
            'email' => 'petugas@pesantren.com'
        ], [
            'name' => 'Petugas Inventory',
            'email' => 'petugas@pesantren.com',
            'password' => Hash::make('petugas123'),
            'email_verified_at' => now(),
        ]);

        User::updateOrCreate([
            'email' => 'ustadz@pesantren.com'
        ], [
            'name' => 'Ustadz Ahmad',
            'email' => 'ustadz@pesantren.com',
            'password' => Hash::make('ustadz123'),
            'email_verified_at' => now(),
        ]);
    }
}
