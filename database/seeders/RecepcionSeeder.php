<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recepcion;
use Carbon\Carbon;

class RecepcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Recepcion::create([
        'fechaHora'=> '2023-06-01',
        'cantidad'=> '100',
        'observacion'=> 'Ninguna',
        'id_basura'=>'6',
        ]);
        Recepcion::create([
            'fechaHora' => Carbon::createFromFormat('Y-m-d', '2023-01-01')->addDays(rand(0, 334)),
            'cantidad' => rand(1, 40),
            'observacion' => 'Ninguna',
            'id_basura' => rand(5, 9),
        ]);

    }
}
