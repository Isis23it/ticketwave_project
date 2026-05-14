<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recinto;

class RecintoSeeder extends Seeder
{
    public function run(): void
    {
        $recintos = [
            [
                'nombre' => 'Auditorio Nacional',
                'ciudad' => 'Ciudad de México',
                'estado' => 'Ciudad de México',
                'colonia' => 'Polanco',
                'pais' => 'México',
                'codigo_postal' => '11560',
                'direccion' => 'Paseo de la Reforma 50',
                'capacidad' => 10000,
                'latitud' => 19.4326,
                'longitud' => -99.2033,
                'activo' => true,
            ],
            [
                'nombre' => 'Estadio Azteca',
                'ciudad' => 'Ciudad de México',
                'estado' => 'Ciudad de México',
                'colonia' => 'Santa Úrsula Coapa',
                'pais' => 'México',
                'codigo_postal' => '14080',
                'direccion' => 'Calzada de Tlalpan 3465',
                'capacidad' => 87000,
                'latitud' => 19.3029,
                'longitud' => -99.1506,
                'activo' => true,
            ],
            [
                'nombre' => 'Teatro Metropólitan',
                'ciudad' => 'Ciudad de México',
                'estado' => 'Ciudad de México',
                'colonia' => 'Centro Histórico',
                'pais' => 'México',
                'codigo_postal' => '06600',
                'direccion' => 'Independencia 90',
                'capacidad' => 1600,
                'latitud' => 19.4284,
                'longitud' => -99.1443,
                'activo' => true,
            ],
        ];

        foreach ($recintos as $recinto) {
            Recinto::create($recinto);
        }
    }
}