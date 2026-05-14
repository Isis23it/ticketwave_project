<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'usuario_id' => User::factory(),
            'estado' => $this->faker->randomElement(['pendiente', 'confirmado', 'cancelado']),
            // decimal(10,2) — monto calculado al momento de crear el pedido
            'monto_total' => $this->faker->randomFloat(2, 100, 10000),
        ];
    }
}