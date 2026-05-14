<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoEntrada;

class TipoEntradaSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            // Evento 1 - Festival de Rock
            ['evento_id' => 1, 'nombre' => 'General', 'descripcion' => 'Acceso general al festival.', 'disponibles' => 500, 'precio' => 800.00, 'limite_por_compra' => 4],
            ['evento_id' => 1, 'nombre' => 'VIP', 'descripcion' => 'Zona exclusiva con mejor vista.', 'disponibles' => 100, 'precio' => 2500.00, 'limite_por_compra' => 2],

            // Evento 2 - Final de Liga MX
            ['evento_id' => 2, 'nombre' => 'Sol', 'descripcion' => 'Zona de sol.', 'disponibles' => 1000, 'precio' => 350.00, 'limite_por_compra' => 6],
            ['evento_id' => 2, 'nombre' => 'Sombra', 'descripcion' => 'Zona de sombra.', 'disponibles' => 500, 'precio' => 650.00, 'limite_por_compra' => 4],

            // Evento 3 - El Fantasma de la Ópera
            ['evento_id' => 3, 'nombre' => 'Platea', 'descripcion' => 'Zona platea.', 'disponibles' => 200, 'precio' => 1200.00, 'limite_por_compra' => 2],
            ['evento_id' => 3, 'nombre' => 'Balcón', 'descripcion' => 'Zona balcón.', 'disponibles' => 150, 'precio' => 800.00, 'limite_por_compra' => 2],

            // Evento 4 - Concierto de Jazz
            ['evento_id' => 4, 'nombre' => 'General', 'descripcion' => 'Acceso general.', 'disponibles' => 300, 'precio' => 600.00, 'limite_por_compra' => 4],
            ['evento_id' => 4, 'nombre' => 'Mesa VIP', 'descripcion' => 'Mesa con servicio incluido.', 'disponibles' => 50, 'precio' => 1800.00, 'limite_por_compra' => 2],

            // Evento 5 - Torneo de Tenis
            ['evento_id' => 5, 'nombre' => 'Cancha Central', 'descripcion' => 'Vista a cancha central.', 'disponibles' => 400, 'precio' => 500.00, 'limite_por_compra' => 4],
            ['evento_id' => 5, 'nombre' => 'Palco', 'descripcion' => 'Palco exclusivo.', 'disponibles' => 50, 'precio' => 1500.00, 'limite_por_compra' => 2],
        ];

        foreach ($tipos as $tipo) {
            TipoEntrada::create($tipo);
        }
    }
}