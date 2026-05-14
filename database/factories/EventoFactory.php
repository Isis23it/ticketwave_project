<?php

namespace Database\Factories;

use App\Models\Recinto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'usuario_id' => User::factory(),
            'recinto_id' => Recinto::factory(),
            'nombre' => $this->faker->sentence(3),
            'descripcion' => $this->faker->paragraph(),
            'categoria' => $this->faker->randomElement(['concierto', 'deporte', 'teatro', 'otro']),
            'imagen_url' => null,
            'estado' => $this->faker->randomElement(['borrador', 'publicado', 'cancelado']),
            'fecha_evento' => $this->faker->dateTimeBetween('+1 month', '+1 year'),
        ];
    }
}