<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorias_reciclable;  
use Illuminate\Support\Facades\DB;

class Categoria_reciclableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('categorias_reciclables')->insert([
            ['nombre' => 'Vidrio'],
            ['nombre' => 'Cartón'],
            ['nombre' => 'Papel'],
            ['nombre' => 'Botella'],
            ['nombre' => 'Plástico'],
            ['nombre' => 'Metal'],
            ['nombre' => 'Electrónicos'],
            ['nombre' => 'Textiles'],
            ['nombre' => 'Madera'],
            ['nombre' => 'Orgánico'],
        ]);

    }
}
