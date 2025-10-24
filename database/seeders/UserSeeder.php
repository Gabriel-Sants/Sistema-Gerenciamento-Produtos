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
         $usuarios = [
            [
                'name' => 'Admin Master',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'João Silva',
                'email' => 'joao@example.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Maria Oliveira',
                'email' => 'maria@example.com',
                'password' => Hash::make('87654321'),
                'email_verified_at' => now(),
            ],
        ];

        User::insert($usuarios);
        User::factory(20)->create();

    }
}
