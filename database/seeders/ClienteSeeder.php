<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cliente = User::create([
            'name' => 'Humberto',
            'apellidos' => 'Lazo Mansilla',
            'email' => 'h@gmail.com',
            'password' => '123456',
            'ci' => '9866028',
            'sexo' => 'M',
            'phone' => '60522218',
            'tipoc' => '1',
            'tipoe' => '0',
        ]);

        $cliente = User::create([
            'name' => 'José Miguel',
            'apellidos' => '',
            'email' => 'j@gmail.com',
            'password' => '123456',
            'ci' => '9866029',
            'sexo' => 'M',
            'phone' => '60522219',
            'tipoc' => '1',
            'tipoe' => '0',
        ]);

        $cliente = User::create([
            'name' => 'Luis Emilio',
            'apellidos' => '',
            'email' => 'l@gmail.com',
            'password' => '123456',
            'ci' => '9864174',
            'sexo' => 'M',
            'phone' => '60521400',
            'tipoc' => '1',
            'tipoe' => '0',
        ]);

        $cliente = User::create([
            'name' => 'Martha',
            'apellidos' => '',
            'email' => 'm@gmail.com',
            'password' => '123456',
            'ci' => '9864175',
            'sexo' => 'F',
            'phone' => '60521401',
            'tipoc' => '1',
            'tipoe' => '0',
        ]);
    }
}
