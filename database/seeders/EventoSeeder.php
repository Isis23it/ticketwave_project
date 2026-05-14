<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evento;

class EventoSeeder extends Seeder
{
    public function run(): void
    {
        $eventos = [
            [
                'usuario_id' => 2,
                'recinto_id' => 1,
                'nombre' => 'Festival de Rock 2026',
                'descripcion' => 'El mejor festival de rock del año.',
                'categoria' => 'concierto',
                'estado' => 'publicado',
                'fecha_evento' => '2026-07-15 20:00:00',
            ],
            [
                'usuario_id' => 2,
                'recinto_id' => 2,
                'nombre' => 'Final de Liga MX',
                'descripcion' => 'La gran final del torneo.',
                'categoria' => 'deporte',
                'estado' => 'publicado',
                'fecha_evento' => '2026-08-01 18:00:00',
            ],
            [
                'usuario_id' => 2,
                'recinto_id' => 3,
                'nombre' => 'El Fantasma de la Ópera',
                'descripcion' => 'El clásico musical en su versión más espectacular.',
                'categoria' => 'teatro',
                'estado' => 'publicado',
                'fecha_evento' => '2026-06-20 19:00:00',
            ],
            [
                'usuario_id' => 2,
                'recinto_id' => 1,
                'nombre' => 'Concierto de Jazz',
                'descripcion' => 'Una noche de jazz en vivo.',
                'categoria' => 'concierto',
                'estado' => 'borrador',
                'fecha_evento' => '2026-09-10 21:00:00',
            ],
            [
                'usuario_id' => 2,
                'recinto_id' => 2,
                'nombre' => 'Torneo de Tenis',
                'descripcion' => 'Torneo internacional de tenis.',
                'categoria' => 'deporte',
                'estado' => 'cancelado',
                'fecha_evento' => '2026-05-01 10:00:00',
            ],
        ];

        foreach ($eventos as $evento) {
            Evento::create($evento);
        }
    }
}