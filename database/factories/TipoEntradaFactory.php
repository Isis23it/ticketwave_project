<?php

namespace Database\Factories;

use App\Models\Evento;
use Illuminate\Database\Eloquent\Factories\Factory;

class TipoEntradaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'evento_id' => Evento::factory(),
            'nombre' => $this->faker->randomElement(['General', 'VIP', 'Platea', 'Balcón', 'Sol', 'Sombra']),
            'descripcion' => $this->faker->sentence(),
            'disponibles' => $this->faker->numberBetween(50, 1000),
            'precio' => $this->faker->randomFloat(2, 100, 5000),
            // null significa sin límite por compra
            'limite_por_compra' => $this->faker->randomElement([2, 4, 6, null]),
        ];
    }
}