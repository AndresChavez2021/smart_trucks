<?php

namespace Database\Seeders;

use App\Models\establecimiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstablecimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Establecimiento::create([
            'nombre' => 'Barrio Villa Union, Barrio San Isidro, Barrio San Fracisco, Barrio 15 de Noviembre, Barrio Polanco Plaza, Barrio LAB, Barrio 8 de Septiembre, Barrino Minero, Barrio Nuevo Mundo',
            'id_ruta' => 1,
            'id_distrito' => 8,
            'id_red' => 1,
        ]);

        Establecimiento::create([
            'nombre' => 'Barrio Palermo, Barrio Norte, Barrio Urbarí, Barrio Fé y Alegría, Barrio Panamericano.',
            'id_ruta' => 2,
            'id_distrito' => 1,
            'id_red' => 1,
        ]);

        Establecimiento::create([
            'nombre' => 'Barrio Los Mangales, Barrio Sonora, Barrio Centenario, Barrio Buena Vista',
            'id_ruta' => 3,
            'id_distrito' => 1,
            'id_red' => 1,
        ]);

        Establecimiento::create([
            'nombre' => 'Barrio Monseñor Peña, Barrio José Gil Soruco, Barrio Nueva Asunción',
            'id_ruta' => 4,
            'id_distrito' => 3,
            'id_red' => 1,
        ]);

        Establecimiento::create([
            'nombre' => 'Barrio Bella Grecia, Barrio , Barrio Los Angeles, Barrio Estación Argentina',
            'id_ruta' => 5,
            'id_distrito' => 3,
            'id_red' => 1,
        ]);

        Establecimiento::create([
            'nombre' => 'Barrio Francisco More',
            'id_ruta' => 6,
            'id_distrito' => 3,
            'id_red' => 1,
        ]);

        Establecimiento::create([
            'nombre' => 'Barrio Sudamericano, Barrio 14 de Junio, Barrio 12 de Julio',
            'id_ruta' => 7,
            'id_distrito' => 3,
            'id_red' => 1,
        ]);

        Establecimiento::create([
            'nombre' => 'Barrio Los Penocos, Barrio 17 de Agosto, Barrio Alfredo Flores',
            'id_ruta' => 8,
            'id_distrito' => 3,
            'id_red' => 1,
        ]);

        Establecimiento::create([
            'nombre' => 'Barrio Transportista Sur',
            'id_ruta' => 9,
            'id_distrito' => 9,
            'id_red' => 1,
        ]);

        Establecimiento::create([
            'nombre' => 'Barrio Militar',
            'id_ruta' => 10,
            'id_distrito' => 9,
            'id_red' => 1,
        ]);
    }
}
