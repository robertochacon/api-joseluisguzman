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
            ['email' => 'admin@gmail.com','name' => 'Administrador','password' => bcrypt('admin'),'created_at' => date("Y-m-d H:i:s")]
        ]);

        DB::table('categories')->insert([
            ['name' => 'Minutos de Oración','created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Tiempo de Lectura','created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Alabare a mi Dios','created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Cuidar mi Cuerpo','created_at' => date("Y-m-d H:i:s")],
        ]);

        Storage::makeDirectory('public/contents');

    }
}
