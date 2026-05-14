<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin principal del sistema
        User::create([
            'name' => 'Admin TicketWave',
            'email' => 'admin@ticketwave.com',
            'password' => Hash::make('password'),
            'rol' => 'admin',
            'activo' => true,
        ]);

        // Organizadores
        User::create([
            'name' => 'Organizador Uno',
            'email' => 'organizador@ticketwave.com',
            'password' => Hash::make('password'),
            'rol' => 'organizador',
            'activo' => true,
        ]);

        // 5 compradores
        $compradores = [
            ['name' => 'Juan Pérez', 'email' => 'juan@example.com'],
            ['name' => 'María García', 'email' => 'maria@example.com'],
            ['name' => 'Carlos López', 'email' => 'carlos@example.com'],
            ['name' => 'Ana Martínez', 'email' => 'ana@example.com'],
            ['name' => 'Luis Rodríguez', 'email' => 'luis@example.com'],
        ];

        foreach ($compradores as $comprador) {
            User::create([
                'name' => $comprador['name'],
                'email' => $comprador['email'],
                'password' => Hash::make('password'),
                'rol' => 'comprador',
                'activo' => true,
            ]);
        }
    }
}