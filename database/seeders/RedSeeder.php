<?php

namespace Database\Seeders;

use App\Models\Red;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Red::create([
            'nombre' => 'Domiciliario',
        ]);

        Red::create([
            'nombre' => 'Comercio',
        ]);

        Red::create([
            'nombre' => 'Hoteles',
        ]);

        Red::create([
            'nombre' => 'Industrias',
        ]);

        Red::create([
            'nombre' => 'Restaurantes',
        ]);

        Red::create([
            'nombre' => 'Mercados',
        ]);

        Red::create([
            'nombre' => 'Posta Sanitarias',
        ]);

        Red::create([
            'nombre' => 'Hospitales de Primer Nivel',
        ]);

        Red::create([
            'nombre' => 'Hospitales de Segundo Nivel',
        ]);

        Red::create([
            'nombre' => 'Hospitales de Tercer Nivel',
        ]);
    }
}
