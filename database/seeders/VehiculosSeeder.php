<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Marca;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Hash;

class VehiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $propietario = User::firstOrCreate(
            ['email' => 'zair@propietario.com'],
            [
                'name' => 'Zair',
                'lastname' => 'Propietario',
                'password' => Hash::make('12345678'),
                'residence' => 'Lima',
                'user_type' => 'propietario',
                'birthdate' => '1990-01-01',
                'cellphone' => '987654321',
            ]
        );

        $vehiculos = [
            [
                'marca' => 'KIA', 'modelo' => 'PICANTO', 'tipo' => 'MEDIANO', 'transmision' => 'MANUAL',
                'pasajeres' => 5, 'precio' => 75.00, 'imagen' => 'kiaPicanto.png', 'anio' => 2022, 'placa' => 'ABC-111', 'rental_status' => 'En renta',
                'aire_acondicionado' => true, 'puertas' => 4
            ],
            [
                'marca' => 'Chevrolet', 'modelo' => 'Onix', 'tipo' => 'MEDIANO', 'transmision' => 'MANUAL',
                'pasajeres' => 5, 'precio' => 90.00, 'imagen' => 'chevrolet.png', 'anio' => 2023, 'placa' => 'DEF-222', 'rental_status' => 'Disponible',
                'aire_acondicionado' => true, 'puertas' => 4
            ],
            [
                'marca' => 'Suzuki', 'modelo' => 'Swift', 'tipo' => 'MEDIANO', 'transmision' => 'MANUAL',
                'pasajeres' => 5, 'precio' => 90.00, 'imagen' => 'suzuki.png', 'anio' => 2021, 'placa' => 'GHI-333', 'rental_status' => 'En renta',
                'aire_acondicionado' => false, 'puertas' => 4
            ],
            [
                'marca' => 'Renault', 'modelo' => 'Kwid', 'tipo' => 'MEDIANO', 'transmision' => 'MANUAL',
                'pasajeres' => 5, 'precio' => 100.00, 'imagen' => 'ranauldKwid.png', 'anio' => 2024, 'placa' => 'JKL-444', 'rental_status' => 'Disponible',
                'aire_acondicionado' => true, 'puertas' => 4
            ],
            [
                'marca' => 'Mercedes-Benz', 'modelo' => 'Clase A', 'tipo' => 'PREMIUM', 'transmision' => 'AUTOMATICO',
                'pasajeres' => 5, 'precio' => 150.00, 'imagen' => 'mercedesBenz.png', 'anio' => 2023, 'placa' => 'MNO-555', 'rental_status' => 'En renta',
                'aire_acondicionado' => true, 'puertas' => 4
            ],
        ];

        foreach ($vehiculos as $vehiculoData) {
            $marca = Marca::firstOrCreate(['nombre' => $vehiculoData['marca']]);

            Vehiculo::updateOrCreate(
                [
                    'placa' => $vehiculoData['placa']
                ],
                [
                    'modelo' => $vehiculoData['modelo'],
                    'propietario_id' => $propietario->id,
                    'marca_id' => $marca->id,
                    'tipo' => $vehiculoData['tipo'],
                    'transmision' => $vehiculoData['transmision'],
                    'pasajeres' => $vehiculoData['pasajeres'],
                    'precio' => $vehiculoData['precio'],
                    'imagen' => $vehiculoData['imagen'],
                    'estado' => 'aprobado',
                    'anio' => $vehiculoData['anio'],
                    'rental_status' => $vehiculoData['rental_status'],
                    'aire_acondicionado' => $vehiculoData['aire_acondicionado'],
                    'puertas' => $vehiculoData['puertas'],
                ]
            );
        }
    }
}
