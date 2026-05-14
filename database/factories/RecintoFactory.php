<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RecintoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company() . ' Arena',
            'ciudad' => $this->faker->city(),
            'estado' => $this->faker->state(),
            'colonia' => $this->faker->streetName(),
            'pais' => 'México',
            'codigo_postal' => $this->faker->numerify('#####'),
            'direccion' => $this->faker->streetAddress(),
            'capacidad' => $this->faker->numberBetween(500, 90000),
            'latitud' => $this->faker->latitude(14, 32),
            'longitud' => $this->faker->longitude(-118, -86),
            'imagen_url' => null,
            'activo' => true,
        ];
    }
}