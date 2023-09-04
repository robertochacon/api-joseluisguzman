<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            ['email' => 'admin@gmail.com','name' => 'Administrador','password' => bcrypt('admin'),'role'=>'admin','created_at' => date("Y-m-d H:i:s")],
            ['email' => 'ejemplo@gmail.com','name' => 'Ejemplo','password' => bcrypt('ejemplo'),'role'=>'user','created_at' => date("Y-m-d H:i:s")]
        ]);

        DB::table('categories')->insert([
            ['name' => 'Peticiones de Oracion','created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Oracion para la familiar','created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Oraciones por el prójimo','created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Oraciones por situaciones','created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Lecturas inspiradoras','created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Temas de Crecimeinto','created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Relacion con Dios','created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Convivenvia','created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Adoración','created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Contemporánea','created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Hip Hoy y Rap','created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Himnos','created_at' => date("Y-m-d H:i:s")],
        ]);

        Storage::makeDirectory('public/contents');

    }
}
