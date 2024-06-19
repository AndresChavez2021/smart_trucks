<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(ZonaSeeder::class);
        $this->call(DistritoSeeder::class);
        $this->call(BarrioSeeder::Class);
        $this->call(HorarioSeeder::class);
        $this->call(RedSeeder::class);
        $this->call(RutaSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(EmpleadoSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(CamionSeeder::class);
        $this->call(BasuraSeeder::class);
        $this->call(EstablecimientoSeeder::class);
        $this->call(DatasetSeeder::class);
        $this->call(AreaCriticaSeeder::class);
        $this->call(RecepcionSeeder::class);
        $this->call(Categoria_reciclableSeeder::class);
    }
}
