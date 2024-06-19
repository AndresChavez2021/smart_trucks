<?php

namespace Database\Seeders;

use App\Models\Camion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CamionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Camion::create([
            'nombre' => 'Vehiculo 1',
            'placa' => '1852PHD',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Vehiculos/1788511315.jpg?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=Lw%2FpUoBzo4%2BdIIkLIZLkEFu1T%2BmAutWz00A2tqOO5lb6WTWBvDvMAAMBHz8Dr4MzNfcni8JJiJFvvkO%2FmeQz4uEW0gpO7U81eojERi6ntnNL9mpAg42wzg%2BKJAfs6vszVwZJMWza0%2FXqbhkRwoJRrFZQBEcbUGEnU56LZ8uwks%2FJ607Ci6BCYB4MlpSkRM%2B64sapWLcj%2BynaVKDJiLsFhlW915e5rw9BXMlA4TWewjSl07wEZJjZMYWiZQYdiT5UUiYw%2B9lUZpxL7wc5fZC26BClTFAu5C3xPCnxPfRwOXbqxZ686%2BMIah0YNisrVVKcPGkax0NzTlPtJ4kh8wuxTg%3D%3D',
            'carpeta' => 'Vehiculos/1788511315.jpg',
            'capacidad_personal' => '6',
            'capacidad_carga' => '15000',
        ]);

        Camion::create([
            'nombre' => 'Vehiculo 2',
            'placa' => '1234ABC',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Vehiculos/1788511316.jpg?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=D9Kanv%2FjbEqIoFnwvfHTwD0ii0ZDJH%2FqkGT4wU1UtaN3Usai8ekgRHBhv4iN7AOiWw%2BNMtwSv5rsajVpJfSLrG3cXY3t2oxu0p%2B%2BrhDGZaeGDsQC8wl2SlBTyQrU9pNMPOh9%2BnVhS%2FHuhrEU%2B%2Blr%2FNfteIBpu9cP1uRuCRyWTVPhxbn9aP9vQiVU1MHvsOBMD6x4P9J%2FfcWuIFujsveCb0il%2B10p06bZI3JkSG%2BSITl%2BDyf18lQ8X5oJ%2Bujxtud0qenWINAYZCBInNJK%2F0kLC38wsWBl%2Fgfc1Yg6se%2BYJVpIZNtS%2FPfATzLIuRPRyCgpFLcfD46bRyTUbFW9S%2BowUw%3D%3D',
            'carpeta' => 'Vehiculos/1788511316.jpg',
            'capacidad_personal' => '6',
            'capacidad_carga' => '15000',
        ]);

        Camion::create([
            'nombre' => 'Vehiculo 3',
            'placa' => '2052FBL',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Vehiculos/1788511317.jpg?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=oHGe5J%2BVbhySWiLnIa8XDlxCcrxtm0wLkefUQYs5yMODiDfcMEAlrVXXCXuHEvsakLpTc6Mo%2BBcYRlbtuLp9aY0eBp1ZpNj7yVxC3sn8J2hsasKA8ekns1s25KVV77GanvaXYXYrfseHWTO5Oo3kMutsPR354bwrx10w%2Ft%2Bxlahkp4bu2Ht5BV%2B9jwmORZGd1LL2UMx5ayc%2FbEcIKioryrSVvxpOO689aI9Uocy3X3EUqev6Eyy7cggMKHS7GGkprZGhyokw3wftNa0AdfvBLXo5fWhtJ3%2B0n%2BTCjwANhENAhYcNo7Yi0V%2Bnf6GW52riK9V1luBuxGyV%2BRyv572mXw%3D%3D',
            'carpeta' => 'Vehiculos/1788511317.jpg',
            'capacidad_personal' => '6',
            'capacidad_carga' => '15000',
        ]);

        Camion::create([
            'nombre' => 'Vehiculo 4',
            'placa' => '2943ABC',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Vehiculos/1788511318.jpeg?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=TgNRjL0DWnejZVpbGkzIUAf%2BGuwlV%2Fayj8GaFU0TQ848EcnX2Wgo7e3Db1rEd8Mp89N4hYwAyNGF%2F0j6k%2F5Vsdjel%2BTYE0TUpDb8Yu5bA0iB8IWxhp7pCXtO3xLuKu7MGwk%2BxhCSeHT9%2FoLQMtxIsFXajvGenZShd7g%2FuodGx1L1Yj73mglF35QPrgq3Ly91tvFNQ8ktZJ58yuU9vyvFasTK4Sd0dtlwDrL%2B8Fv6vKFrpNeRm4FLrWv1fCjIHfoVpFSxS4y%2FhQhcz6UNqRfxWcGKd4T%2BB3NOL28NEsLqJsxrkvzTPk7V3U5j5km1n4zCow8I6gndfTa6C2Q0JAA3QQ%3D%3D',
            'carpeta' => 'Vehiculos/1788511318.jpeg',
            'capacidad_personal' => '6',
            'capacidad_carga' => '15000',
        ]);

        Camion::create([
            'nombre' => 'Vehiculo 5',
            'placa' => '1000BOL',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Vehiculos/1788511319.jpg?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=W7o34FGQe1KGBzauL68t5vyYVAyh1qk807EY0ezp34MUZ5MEu4%2Fv8B1LQrmxC%2BXGsShJmOmiNCoHpKdrFWU7VcCjQfs8drKUdD0DF7PnBS4bnkfmKB%2FF8%2F5DTQx5dZlCYCpZL%2F03YunKHWRfIGRr5uR6vBqKW46Ok29u2vKFA5LrM3kf3Fp%2FoQgJ7xw5lWe4cYJ6IVn6Ogt0Ilca8hSu7HB9uc8KAO0Cp4HoEb8EUz2C3%2F8O%2BB4S4DC4pTR5E5oJfIPoFFmG9MDV3M4ifORksTh8NtKIerlJmVvwA9fCjoMmPgua3RdT32GVihC9XxSeSgqAGSouUcDtYzdUvTNqMw%3D%3D',
            'carpeta' => 'Vehiculos/1788511319.jpg',
            'capacidad_personal' => '6',
            'capacidad_carga' => '15000',
        ]);

        Camion::create([
            'nombre' => 'Vehiculo 6',
            'placa' => '2291PSX',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Vehiculos/1788511320.png?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=jxQV%2Bq6AISykc3eQUIJkxqL%2B3ueipJ3jm7RnxcvoVlpdlhKG%2Btt55GQGATz1NkfkJg7ZZVJ8c2aaOcDrWl%2BVfpvbuuwS6TdKusXcNuLmm0tKfSCkK3EklILzjoSBO0oiCBM%2FBISE7sF6PJ6lqWIHXdfa%2FvKtSFS%2FuHfy%2Bc0DMd8rl%2FlJWNo6XxhAXKN7S6CDoU4wOxHxCudkdSdHV8hZ4Jvf4anGROIt2RqN8OYW7qcGSzx4b4om6XqOohZUhI%2BKOZqKi1p%2FTmuSbCcVU3QEHweie5N77Yv%2FuQt4sY5lX2nhhXxtUiHsUXoB6jx%2Fg64PMq3P3TOCIc5VflzvcUrz9g%3D%3D',
            'carpeta' => 'Vehiculos/1788511320.png',
            'capacidad_personal' => '6',
            'capacidad_carga' => '15000',
        ]);
    }
}
