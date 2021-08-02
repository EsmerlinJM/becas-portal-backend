<?php

namespace Database\Seeders;

use App\Models\DevelopmentArea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DevelopmentAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('development_areas')->insert([
            ['name' => 'Arquitectura', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Cultura', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Biología', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Administración', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Química', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Comunicación', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Ciencias de la Computación', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Análisis de datos y estadísticas', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Diseño', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Economía y Finanzas', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Educación', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Electrónica', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Energía', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Ingenieria', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Ética', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Salud', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Historia', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Humanidades', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Leyes', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Literatura', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Matemáticas', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Música', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Filosofía y Ética', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Física', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Ciencias', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Ciencias Sociales', 'active' => '1', 'created_at' => Carbon::now()],
        ]);
    }
}