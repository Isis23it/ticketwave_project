<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RecintoSeeder::class,
            EventoSeeder::class,
            TipoEntradaSeeder::class,
            PedidoSeeder::class,
        ]);
    }
}