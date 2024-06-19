<?php

namespace Database\Seeders;

use App\Models\Distrito;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Distrito::create([
            'nombre' => 'Distrito 1',
            'descripcion' => 'Se creó el 10 de septiembre 1954. Está ubicado en la zona Oeste de la ciudad. Lo integran aproximadamente 70 barrios y cuenta con una población de 112 mil habitantes',
            'id_zona' => 1
        ]);

        Distrito::create([
            'nombre' => 'Distrito 2',
            'descripcion' => 'Se creó el 17 de septiembre de 1950, pero el 19 de septiembre de 1994 con la Ley de Participación Popular el Distrito 2 quedó consolidado. Aproximadamente 87 mil habitantes viven en 24 barrios que forman 15 unidades vecinales.',
            'id_zona' => 1
        ]);

        Distrito::create([
            'nombre' => 'Distrito 3',
            'descripcion' => 'Se creó el 6 de diciembre en el Plan Director de 1995. Cuenta con más de 75.000 habitantes, tiene 11 unidades vecinales y 30 barrios. Comprende desde el segundo anillo hasta el quinto anillo entre avenidas La Barranca',
            'id_zona' => 2
        ]);

        Distrito::create([
            'nombre' => 'Distrito 4',
            'descripcion' => 'fue fundado en 1957. Su nombre es en honor al legado histórico donde se desarrolló la batalla del mismo nombre, durante las gestas libertarias cruceñas. Lo conforman 19 barrios, 10 unidades vecinales y una población aproximada de 80 mil habitantes',
            'id_zona' => 2
        ]);

        Distrito::create([
            'nombre' => 'Distrito 5',
            'descripcion' => 'fue creado en 1995. En esa fecha realizan manifestaciones culturales en las que participan las unidades educativas. Tiene una población de 200 mil habitantes.',
            'id_zona' => 1
        ]);

        Distrito::create([
            'nombre' => 'Distrito 6',
            'descripcion' => 'Se fundó el 14 de agosto de 1960. Antiguamente era un campo de extensas tierras desoladas e islas vegetales que servían de pascana a los ganaderos y carretones. Su población supera los 200 mil habitantes.',
            'id_zona' => 1
        ]);

        Distrito::create([
            'nombre' => 'Distrito 7',
            'descripcion' => 'Se ubica fuera del 4to anillo al este de la ciudad. Al menos, unas 40 familias fundaron esta ciudadela en 1969. Se escogió este nombre en homenaje a la gente trabajadora de la zona. Tiene poco más de 200 mil habitantes',
            'id_zona' => 1
        ]);

        Distrito::create([
            'nombre' => 'Distrito 8',
            'descripcion' => 'Fue creada el 18 de marzo de 1983, debido a la riada del río Piraí en la que más de tres mil familias quedaron sin hogar. El Plan Tres Mil alberga a más de 380 mil habitantes',
            'id_zona' => 2
        ]);

        Distrito::create([
            'nombre' => 'Distrito 9',
            'descripcion' => 'Nació en 1986 y fue reconocido como distrito en 1990, posteriormente, en 1995 se definió el 9 de septiembre como fecha de aniversario, está ubicado en la zona Suroeste de la ciudad. Tiene una población aproximada de 130 mil habitantes',
            'id_zona' => 2
        ]);

        Distrito::create([
            'nombre' => 'Distrito 10',
            'descripcion' => 'La antigua Villa Víctor Paz Estenssoro está situada en la zona Suroeste de la ciudad. Fue fundada el 15 de mayo de 1953, pero ha crecido bastante hasta convertirse hoy en el DM10, una ciudadela con una población estimada de 250 mil personas.',
            'id_zona' => 2
        ]);

        Distrito::create([
            'nombre' => 'Distrito 11',
            'descripcion' => 'Celebra su aniversario cada 26 de febrero. Corresponde a la Ciudad Vieja que, desde su traslado hasta mediados del siglo pasado, no sobrepasaba el 2do anillo, su población es de 163.000 habitantes',
            'id_zona' => 1
        ]);

        Distrito::create([
            'nombre' => 'Distrito 12',
            'descripcion' => 'La ciudadela Nuevo Palmar fue creada como distrito municipal mediante Ordenanza Municipal 031 del 14 de mayo de 1999. Está ubicado en la zona Sur y es el más nuevo de la ciudad. Tiene más de 150 mil habitantes.',
            'id_zona' => 2
        ]);

        Distrito::create([
            'nombre' => 'Distrito 13',
            'descripcion' => 'época de la colonia, los españoles llegaban al lugar para orar. El 10 de septiembre de 1996 fue creado como distrito. Tiene una población aproximada de 25 mil habitantes',
            'id_zona' => 2
        ]);

        Distrito::create([
            'nombre' => 'Distrito 14',
            'descripcion' => 'Fue creado por orden de la Real Cédula en un lugar intermedio entre el río Piraí y el río Guapay. Fundado el 1 de febrero de 1621 y fue poblado por familias españolas que venían a refugiarse del asedio de los chiriguanos.',
            'id_zona' => 2
        ]);

        Distrito::create([
            'nombre' => 'Distrito 15',
            'descripcion' => 'Fue fundado como cantón el 25 de marzo de 1938 por Constantino Montero Hoyos, un ingeniero que explotaba oro y madera en la zona y que vio la necesidad de establecer un nexo entre Santa Cruz y Guarayos. Tiene aproximadamente 5.500 mil habitantes.',
            'id_zona' => 1
        ]);
    }
}
