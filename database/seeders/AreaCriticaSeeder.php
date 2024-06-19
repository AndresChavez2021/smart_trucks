<?php

namespace Database\Seeders;

use App\Models\AreaCritica;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaCriticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AreaCritica::create([
            'latitud' => '-17.819543826999926',
            'longitud' => '-63.120557407481336',
            'radio' => '15',
            'id_ruta' => '1',
        ]);

        AreaCritica::create([
            'latitud' => '-17.824037983503654',
            'longitud' => '-63.12926922236171',
            'radio' => '15',
            'id_ruta' => '1',
        ]);
    }
}
