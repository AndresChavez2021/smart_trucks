<?php

namespace Database\Seeders;

use App\Models\Horario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Horario::create([
            'dia_semana' => 'Martes, Jueves, Sábado',
            'hora_inicio' => '08:00:00',
            'hora_fin' => '16:00:00',
        ]);
        Horario::create([
            'dia_semana' => 'Lunes, Miércoles, Viernes',
            'hora_inicio' => '08:00:00',
            'hora_fin' => '16:00:00',
        ]);
        Horario::create([
            'dia_semana' => 'Lunes, Martes, Miércoles',
            'hora_inicio' => '08:00:00',
            'hora_fin' => '16:00:00',
        ]);
        Horario::create([
            'dia_semana' => 'Miércoles, Jueves, Viernes',
            'hora_inicio' => '08:00:00',
            'hora_fin' => '16:00:00',
        ]);
        Horario::create([
            'dia_semana' => 'Sábado, Domingo',
            'hora_inicio' => '08:00:00',
            'hora_fin' => '16:00:00',
        ]);
    }
}
