<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            [
                'email' => 'admin@gmail.com',
            ],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
            ]
        );

        // Kasir 1
        User::updateOrCreate(
            [
                'email' => 'kasir1@gmail.com',
            ],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('kasirbudi12345'),
                'role' => 'kasir',
            ]
        );

        // Kasir 2
        User::updateOrCreate(
            [
                'email' => 'kasir2@gmail.com',
            ],
            [
                'name' => 'Agus',
                'password' => Hash::make('kasiragus12345'),
                'role' => 'kasir',
            ]
        );
    }
}