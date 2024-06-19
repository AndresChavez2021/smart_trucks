<?php

namespace Database\Seeders;
use App\Models\Barrio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarrioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barrio::create([
            'nombre'=>'barrio transportista sur',
            'coordenada'=>'[{"lat":-17.842226161584374,"lng": -63.17336326965555}]',
            'id_distrito'=>'9',
           ]);
           
           
           Barrio::create([
            'nombre'=>'barrio tierras nuevas',
            //-17.84667198235528, -63.213163299007434
            'coordenada'=>'[{"lat": -17.84667198235528,"lng": -63.213163299007434}]',
            'id_distrito'=>'9',
           ]);
           
           
           //nuevos cosas
          
           Barrio::create([
            'nombre'=>'Av.26 de febrero',
            'coordenada'=>'[{"lat":-17.77626694817599,"lng": -63.19290064480248}]',
            'id_distrito'=>'1',
           ]);
           
            Barrio::create([
            'nombre'=>'Bush',
            'coordenada'=>'[{"lat":-17.772960,"lng": -63.196997}]',
            'id_distrito'=>'1',
           ]);
           
           
           Barrio::create([
            'nombre'=>'Hernando sanabria',
            'coordenada'=>'[{"lat":-17.778473,"lng": 63.199080}]',
            'id_distrito'=>'1',
           ]);
           
          
           Barrio::create([
            'nombre'=>'Barrio Equipetrol',
            'coordenada'=>'[{"lat":-17.767460,"lng": -63.194004}]',
            'id_distrito'=>'1',
           ]);
           
        
           Barrio::create([
            'nombre'=>'Club de tenis SCZ',
            'coordenada'=>'[{"lat":-17.782208,"lng": -63.198787}]',
            'id_distrito'=>'1',
           ]);
           
           
           Barrio::create([
            'nombre'=>'Santa Rosita',
            'coordenada'=>'[{"lat":-17.788970,"lng": -63.199874}]',
            'id_distrito'=>'1',
           ]);
           
           Barrio::create([
            'nombre'=>'B.Urbari',
            'coordenada'=>'[{"lat":-17.796422,"lng": -63.198519}]',
            'id_distrito'=>'4',
           ]);
           
           
           Barrio::create([
            'nombre'=>'La ramada-Grigota',
            'coordenada'=>'[{"lat":-17.795867,"lng": -63.190347}]',
            'id_distrito'=>'4',
           ]);
           
    
           Barrio::create([
            'nombre'=>'Tahuichi aguilera',
            'coordenada'=>'[{"lat":-17.797736,"lng": -63.184027}]',
            'id_distrito'=>'4',
           ]);
           
          
           Barrio::create([
            'nombre'=>'San marcos',
            'coordenada'=>'[{"lat":-17.840692,"lng": -63.209940}]',
            'id_distrito'=>'9',
           ]);
           
           Barrio::create([
            'nombre'=>'Blacutt',
            'coordenada'=>'[{"lat":-17.794629,"lng": -63.179657}]',
            'id_distrito'=>'4',
           ]);
           
           Barrio::create([
            'nombre'=>'Barrio Panamericano',
            'coordenada'=>'[{"lat":-17.776554,"lng":-63.189458}]',
            'id_distrito'=>'4',
           ]);
          
       
    }
}
