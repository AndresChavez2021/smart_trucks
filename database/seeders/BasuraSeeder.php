<?php

namespace Database\Seeders;

use App\Models\Basura;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BasuraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Basura::create([
            'nombre' => 'Residuos Domiciliarios',
            'precio_venta'=>'0',
            'tipo'=>'No Reciclable'
        ]);

        Basura::create([
            'nombre' => 'Residuos de Mercados',
            'precio_venta'=>'0',
            'tipo'=>'No Reciclable'
        ]);

        Basura::create([
            'nombre' => 'Residuos Industriales y Comerciales',
            'precio_venta'=>'0',
            'tipo'=>'No Reciclable'
        ]);

        Basura::create([
            'nombre' => 'Residuos Hospitalarios',
            'precio_venta'=>'0',
            'tipo'=>'No Reciclable'
        ]);

        Basura::create([
            'nombre' => 'Latas de aluminio',
            'precio_venta'=>'9',
            'tipo'=>'Reciclable'
        ]);

        Basura::create([
            'nombre' => 'Cartón ',
            'precio_venta'=>'1',
            'tipo'=>'Reciclable'
        ]);

        Basura::create([
            'nombre' => 'Botellas de vidrio',
            'precio_venta'=>'0.70',
            'tipo'=>'Reciclable'
        ]);

        Basura::create([
            'nombre' => 'botellas plásticas',
            'precio_venta'=>'2',
            'tipo'=>'Reciclable'
        ]);
        
        Basura::create([
            'nombre' => 'cobre',
            'precio_venta'=>'20',
            'tipo'=>'Reciclable'
        ]);
    }
}
