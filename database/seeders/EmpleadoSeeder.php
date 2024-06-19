<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Administrador',
            'apellidos' => '',
            'email' => 'admin@gmail.com',
            'password' => '123456',
            'ci' => '9866021',
            'sexo' => 'M',
            'phone' => '60522212',
            'domicilio' => 'Santa Cruz',
            'estado' => '1',
            'sueldo' => '3000',
            'tipoc' => '0',
            'tipoe' => '1',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Empleados/1688511326.png?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=pWjpmFgyDH5%2BEMlDzpV3W1j6GY7mGgdZ4AXLClnleHtLfbYOejJX7k1kTKw%2FPDOD3IjEhrgjnCW2d%2BQMQDF3XqS39wmlTVW%2Fiq7KiWszki72Ed72IJdB8MnLLMpHt5x417OmLaU9VKsMrtWr7p%2BTdIaSrcsu4uh%2F8xFj7aHMqIfP9RfudX9hHRZs9i%2BePtVNLLu01eJzO52z%2FJlgRXeNHp0qagtWw8GooQKyEwimSgSiy6mQXc2zF7G5nBDGJrqGkowUpAAlSYe0gWsh0GRMT7ZbrOSjlcXf2kUIFf1uP%2FqTaKUa%2FkW1o0l8Sla5YxbKMrf%2B%2FRW9dES%2BF0t6O3MOYw%3D%3D ',
            'carpeta' => 'Empleados/1688511326.png',
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Michael',
            'apellidos' => 'Humerez',
            'email' => 'Michael@gmail.com',
            'password' => '123456',
            'ci' => '9866024',
            'sexo' => 'M',
            'phone' => '60522214',
            'domicilio' => 'Santa Cruz',
            'estado' => '1',
            'sueldo' => '3000',
            'tipoc' => '0',
            'tipoe' => '1',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Empleados/1688511314.png?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=XByKR2mLO2CKwp2hKdnDTnAmp9rKvb7%2BSx4%2FIC%2FL9IY%2FChwEkBoDHOxqK3XkC6dStCX%2FzOEXpMQnFsSGmnjDjUiZW7RoTSRnhbx0OIJHwAkbRe%2B1Odv7osADabJu8ZA%2BGGSz%2BeF4ErosYTixYY1P0TjGBWrbDp0CB8qDoZHBzMK3NaQh%2B%2FHiuEpTBAbPAVaScUcND3psuX8z9BOUDXgsvl7b2fbZcxOJl1WjHS6EMcWDxKeMja9V%2FV1SOEUOnloHK6QIviWc%2BoGhB9zJaQFJ9MOVm9OIeei9C8I%2B4DrZkmlxtHHQGLcS8BBbM1xvDyDthOyb2pHhF%2Fn%2BOk0DxWueRQ%3D%3D',
            'carpeta' => 'Empleados/1688511314.png',
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Brayan',
            'apellidos' => 'Myers',
            'email' => 'Brayan@gmail.com',
            'password' => '123456',
            'ci' => '9866022',
            'sexo' => 'M',
            'phone' => '60522211',
            'domicilio' => 'Santa Cruz',
            'estado' => '1',
            'sueldo' => '2500',
            'tipoc' => '0',
            'tipoe' => '1',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Empleados/1688511315.png?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=E7NHBQCphz9qof9mCL7F1oE0GELd3GRyt5KQ8biHs6b0FSsDVpV8w3i0xJF3uQqbSkxHHDwjNYQQIyvNozW5TIC2EffHHNLgsk1Du9r8rVPiH5gMwZfBbb5YjWyxaL39AbToAEwNjb6ZufPcsaGWHWTiEaaOf5SdWmHHp9SIFKlnxBOne%2F%2FtIiuHJRo89o0aZmpvbsXtD%2BW7admQIpYBF9Ga%2FxeIEMNR7P0uKWpYBxuNUCm5p1eAJO53qiw5R1WxOEninDw%2Fw1wDBueLuEKZX8lHDAnaz%2F%2BDHwSJMrK3KAcoHszsYvpe%2BeHxFB1ulbcUb%2BkHxZRlQvN8eLVAdIq4pQ%3D%3D',
            'carpeta' => 'Empleados/1688511315.png',
        ])->assignRole('Conductor');

        User::create([
            'name' => 'Camilo',
            'apellidos' => 'Waller',
            'email' => 'Camilo@gmail.com',
            'password' => '123456',
            'ci' => '9866023',
            'sexo' => 'M',
            'phone' => '60522213',
            'domicilio' => 'Santa Cruz',
            'estado' => '1',
            'sueldo' => '2500',
            'tipoc' => '0',
            'tipoe' => '1',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Empleados/1688511316.png?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=m6d8PHNJQqyKfXKzVfgJqflBKOS4hgtxC%2FkgFlA%2FKuDKfF1khs66ZIF1bO6yzYJLxUJrz%2FyRsDOHtils71g%2BGL1jlDRhufrCBHtekDwYzKMh%2FRrDfWJ%2FUb3BvXdoYUtBCNZurFZs3MXAHZjBwBs9k8whUkhwC4BWxhz8wfdcgBcy%2BGBBbKC7fTq%2F41t%2FfEZb3jEpmkdVx8wuladYYrOc8m0b%2B8Btes6XVB2uf1gW1PKdQjTkAfqD59W1fCqHUlbzYL1Lmz2frNd8vklwJT6v%2B7xvwUEbiW5f9EZgxd3NAvddNwyqYuxUfLq128fvsox%2FsEpdn6FKpPcl0GXSVvgmeg%3D%3D',
            'carpeta' => 'Empleados/1688511316.png',
        ])->assignRole('Conductor');

        User::create([
            'name' => 'Kane',
            'apellidos' => 'Grimes',
            'email' => 'Kane@gmail.com',
            'password' => '123456',
            'ci' => '1247635',
            'sexo' => 'M',
            'phone' => '70055574',
            'domicilio' => 'Santa Cruz',
            'estado' => '1',
            'sueldo' => '2500',
            'tipoc' => '0',
            'tipoe' => '1',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Empleados/1688345509.png?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=cFQClH614WdhsowdlNJCRCoJ%2FvR5Tox%2BcL5dyZY%2BDQPRpoPQ6NMvrGa6XsYxgqWt0d0Iz5KrHP0gz54sLdZep%2Bzfp39zYx06qO%2B4T1J%2F1mJzT6VWTzrH5Zt1TR5V0Z0zlKaD%2FeAnlaZ4a%2F7ETayHd%2FafsjBCtnbw7nKMZdBuQ4yA3ABxkBgWKliBZQJMyJ9zVpbX3UJwU0u4aBuG1mjImV78KHGtUCKOUEVH%2B%2FJlUluMimQ6Sv%2B7f3RVsPO%2FnDsJj%2FhH4EUIR5CRT3Q4u51BQWK%2F1wMbtnE3cBhijghPRltX9%2FRQBjFfsdlMrkE2T1xBV1RbTUvQgfCg%2F7la9Jcm%2FQ%3D%3D',
            'carpeta' => 'Empleados/1688345509.png',
        ])->assignRole('Conductor');

        User::create([
            'name' => 'Reese',
            'apellidos' => 'Horn',
            'email' => 'Reese@gmail.com',
            'password' => '123456',
            'ci' => '6533104',
            'sexo' => 'M',
            'phone' => '63344472',
            'domicilio' => 'Santa Cruz',
            'estado' => '1',
            'sueldo' => '2500',
            'tipoc' => '0',
            'tipoe' => '1',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Empleados/1688511318.png?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=MgLaActHdQ08l%2BiJr5Sf3u%2BebMmnENPYuWi5yOQSefDfJjpq%2Boz3X90HHEAmw8ZzpCzPF%2B3z3w2EvUKqhpFecr5CcNvGao4dWWepkTTs0rW3BfmEvYfcIfUh1mVsvwjYrYmCsWJAi9tm40qxv3ePlJMQxtZMQurS3a1aUZ3291ME4Zib5HIuRrL3mV%2FnzLo8m%2BhTVAPXJrlxwKBtdhQqzkJKVekVYItzBq5aj8y8QReo5Zp1U1X7lW8c4kDa4voNaCpsmqc7%2BO0B6VWyC4UkcRgjrTjiB3qwIqDVUOsUnHDEOFTd66ZnOg%2FXClmLoeFoGNYqBkQ0yv%2BaGUFCWmQm2w%3D%3D',
            'carpeta' => 'Empleados/1688511318.png',
        ])->assignRole('Recogedor');

        User::create([
            'name' => 'Noah',
            'apellidos' => 'Conner',
            'email' => 'Noah@gmail.com',
            'password' => '123456',
            'ci' => '5844214',
            'sexo' => 'M',
            'phone' => '71455620',
            'domicilio' => 'Santa Cruz',
            'estado' => '1',
            'sueldo' => '2500',
            'tipoc' => '0',
            'tipoe' => '1',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Empleados/1688511319.png?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=TeZ0JDaPotv70jAE6Kk87tDZA%2Fn4n4jpxwopODU%2FjWNvLb%2FRuZL04QIxzt02NFBtY0cmN%2B0NnyuEMWwS0k5mf0Nt0pSDBQANLE4zk0g5%2BGRxz1Arpjo8gN6UVWER4OwRMIc7Kvza3cDYtCC4wUclCASpX9cbVF38%2BMYq3eTMTuqjyN6nBZnNq9axdC0hEoqLkvsh3zVt0nEULbjjUimWH7U4TqQK6xnU%2F7ebdPkAeBTEmYuOLUIf0KkafD4L%2Fz54l4VTeSqnc8DoIELIo586CuPmZ1oWoubAEliFN0RpPG2njYpe88a6%2F2aWlPHjlPpW%2BxCpE2VXNLlkA1Q0MmPvtg%3D%3D',
            'carpeta' => 'Empleados/1688511319.png',
        ])->assignRole('Recogedor');

        User::create([
            'name' => 'Dylan',
            'apellidos' => 'Allen',
            'email' => 'Dylan@gmail.com',
            'password' => '123456',
            'ci' => '6527194',
            'sexo' => 'M',
            'phone' => '65798924',
            'domicilio' => 'Santa Cruz',
            'estado' => '1',
            'sueldo' => '2500',
            'tipoc' => '0',
            'tipoe' => '1',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Empleados/1688511320.png?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=cuc0%2F9L3y7k%2FgPfFZOp4Hf10wPNKUYrhQVFph8sOAadCMHIoYfx%2F4CAfSD%2FBla0RGZFN3ZNnqgJrJUee4FgIPpumTeZt9ptonp9It%2BBj%2FrwfwA3fSF8odAwfcnNxdTHrgyE4eOiqv9FdBglzHfVWmz67QKJ29w0rDag%2FIV%2FSBw2kYcP0buTc8aEhhDvw32kmALt9Th5MwaZrE19SzUT5cIOK0ZuZM5pNiS8jxa52iUlyolXHedZGWi5uVkMv1BRuxUwtQ5nCKi%2FfwwqAJmLijJqUIuHBR8%2FqIs2xkHKPXmrCkkPij0xytnAyvohO2CI5Me60q1CHf0jF27vGskScrg%3D%3D',
            'carpeta' => 'Empleados/1688511320.png',
        ])->assignRole('Recogedor');

        User::create([
            'name' => 'Ryan',
            'apellidos' => 'Blevins',
            'email' => 'Ryan@gmail.com',
            'password' => '123456',
            'ci' => '6570030',
            'sexo' => 'M',
            'phone' => '60012300',
            'domicilio' => 'Santa Cruz',
            'estado' => '1',
            'sueldo' => '2500',
            'tipoc' => '0',
            'tipoe' => '1',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Empleados/1688511321.png?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=TBUXsc9AY4U%2BD%2BgJGVmycnOUpJlAkIHbeIFMsXsARgZdYe%2Be82NpLbN7FgOtDvcFYli%2Bp26z2LWkI%2BapZQdhfp7fDt9BfyqzdwlNcWkhKyZk7AbucdpdabQUPnDzn8RJgcO6p2PnI3HWWXls%2BN4pYRgZatECJffUe%2BEnC2VxoIirK7WrP627k0z6ks15zmnbaz5ynWEEIj1MgfjJkCly%2B7utFMfi76uv3xIvxGO3X2LkH5J60C44VUZI9mngNktBceKDEcfFY7TYnvkns5K8lCjYNlsvCgJWj4GNIJM5jGjNo%2BA46zaM4KdT4dQOgi2tR9%2FbQI2%2BHcQDsj%2BjepJUjA%3D%3D',
            'carpeta' => 'Empleados/1688511321.png',
        ])->assignRole('Recogedor');

        User::create([
            'name' => 'Jerome',
            'apellidos' => 'Miranda',
            'email' => 'Jerome@gmail.com',
            'password' => '123456',
            'ci' => '9617000',
            'sexo' => 'M',
            'phone' => '70001201',
            'domicilio' => 'Santa Cruz',
            'estado' => '1',
            'sueldo' => '2500',
            'tipoc' => '0',
            'tipoe' => '1',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Empleados/1688511322.png?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=grofWH7oAcqCXEvHeq4Av8WvcSUU9akiUWwh4themtTdDuHJQxOrIH%2F3Le1tanGE2YsxD%2BXlQH%2B65Ehuw10565vuGR%2BvCipBERurRhSPcQVgqOX%2B8k2cyfFuF9jYRG1pN%2F14B9DmR%2BlvjInVXQ%2B%2BP9rlPBBGikduD%2FhwPJe%2Bkj0EtQR7CvOfGDMN%2Fys9yF9CG8LPQXjwq0B8H5jkn7czz3SKD%2BcCGZUV7t%2BTZwdQADEEvLjQjHDvQBiv8deziTq3NTJ4Tmiz%2BN0WNlmJZM8veWSrRh4%2FIpmhnk8lrDXGxObUyX8mbeV6ozfY3qrNvv9voS5FHMRDZLtgat2smxpM2w%3D%3D',
            'carpeta' => 'Empleados/1688511322.png',
        ])->assignRole('Recogedor');

        User::create([
            'name' => 'Jaime',
            'apellidos' => 'Booner',
            'email' => 'Jaime@gmail.com',
            'password' => '123456',
            'ci' => '5524101',
            'sexo' => 'M',
            'phone' => '76421325',
            'domicilio' => 'Santa Cruz',
            'estado' => '1',
            'sueldo' => '2100',
            'tipoc' => '0',
            'tipoe' => '1',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Empleados/1688511323.png?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=fe5Ogpn0WWC%2Bz0D%2B5bxIGo70gL08OUdsFTeeknGtn07Z38sYoXiX8g7PrZiHTIH1uYx6%2FifUy0h9mYIODaEX79Nz6qAvNww2HrTbVebKvx4mIg0%2FGdNuafqMaCKT%2BScGpXhRf7SKtZ7G6neq%2BMNeRMa7XgAV3wfdrx3WQWDCFhMdafDlN5Ft1ZMk%2FT3gnoYaOFbzhMTX89KiKYXXLlfinqenER%2BtayuywVkFAWJOTZ9q7PW4BS%2B1lcQxwH2l4XUDSYJCBiHVzDtSbwVufVRlY6gU0LdldLtjBaA6vveWEq4r4bxywSCZpLeytmvpAODivKJMGIEga3tIPOZiOczVIg%3D%3D',
            'carpeta' => 'Empleados/1688511323.png',
        ])->assignRole('Ayudante');

        User::create([
            'name' => 'Tobias',
            'apellidos' => 'Perry',
            'email' => 'Tobias@gmail.com',
            'password' => '123456',
            'ci' => '4756147',
            'sexo' => 'M',
            'phone' => '74520014',
            'domicilio' => 'Santa Cruz',
            'estado' => '1',
            'sueldo' => '2100',
            'tipoc' => '0',
            'tipoe' => '1',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Empleados/1688511324.png?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=K%2BRfI7%2F7RWoYyHH25Gxn%2Fm8vKmjxvLDFoEvRp9wtlvH%2FgHwAY6BuMyxFoEYSIb6wrCsACX0127APwfQDD7jI1UA1d95hXp1nylV3atyB4kNVdrVtdO3DWOnDrDLeqixest03ztY6f7tMqO0JTzZodtPdpqa%2Ftlmk3l%2BPfeGGQS%2B8TlMXJQU1CosRMVRx%2BqmK5bcpXGZvBW%2FpwVczBodqLQZATi6bGP6A8Ed9GQdPnmr5%2Fgm8qvpShXHNZtU9jbbyd9dUwSvl7Ez3gaZMcmM3uvVGGoW2QIg2mJR%2B3HeKdNXl1kDa0gzAZ8PFCkhIFkhCEF2DsceqWAkao04HqjUfCg%3D%3D',
            'carpeta' => 'Empleados/1688511324.png',
        ])->assignRole('Ayudante');

        User::create([
            'name' => 'Scott',
            'apellidos' => 'Dickerson',
            'email' => 'Scott@gmail.com',
            'password' => '123456',
            'ci' => '6584201',
            'sexo' => 'M',
            'phone' => '63001241',
            'domicilio' => 'Santa Cruz',
            'estado' => '1',
            'sueldo' => '2100',
            'tipoc' => '0',
            'tipoe' => '1',
            'image' => 'https://storage.googleapis.com/smart-trucks-41e25.appspot.com/Empleados/1688511325.png?GoogleAccessId=firebase-adminsdk-r5qsx%40smart-trucks-41e25.iam.gserviceaccount.com&Expires=1703894400&Signature=hYEnGn%2BPBU8%2F26vSQ3kpgGSYO1bCtNa6FS1e0tyn7AlKk4ejSEyak2b3Lupma%2BbEJqpwEfvpi3K5U6Qc9fnQ30jHcIM8lxID01wFEjLkm%2FZXq61MerousJ%2BgtYovi6OeMXDwkvo9HIWozrcmDYWYc3y8OFzpEbA35ORyeC7ZQz9N1pZYJYqZIXDKwur67wWsCkeHHyaLYgFnfvQMnoABgV3L7gqspkTb6UYxVDZJcZsI6x63mQcyINVMFLuAMbE2ZZUDI97TGwJbXKzyYnQSe3GkswaYbyE8tzS3wJ7Zk1UfZbOnExiB%2FjyXMB1gJ%2F3K01HN8%2F0tQUVNVLHW0eESLg%3D%3D',
            'carpeta' => 'Empleados/1688511325.png',
        ])->assignRole('Ayudante');
    }
}
