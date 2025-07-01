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
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create petugas 1
        User::updateOrCreate([
            'email' => 'petugas1@pesantren.com'
        ], [
            'name' => 'Petugas Satu',
            'email' => 'petugas1@pesantren.com',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
            'email_verified_at' => now(),
        ]);

        // Create petugas 2
        User::updateOrCreate([
            'email' => 'petugas2@pesantren.com'
        ], [
            'name' => 'Petugas Dua',
            'email' => 'petugas2@pesantren.com',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
            'email_verified_at' => now(),
        ]);

        // Create ustadz
        User::updateOrCreate([
            'email' => 'ustadz@pesantren.com'
        ], [
            'name' => 'Ustadz Ahmad',
            'email' => 'ustadz@pesantren.com',
            'password' => Hash::make('ustadz123'),
            'role' => 'ustadz',
            'email_verified_at' => now(),
        ]);
    }
}
