<?php

namespace Database\Seeders;

use App\Models\Modulo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ModulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modulos')->insert([
            ['name' => 'admin', 'description' => 'Modulo Administrativo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'evaluadores', 'description' => 'Modulo Evaluadores', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'coordinadores', 'description' => 'Modulo Coordinadores', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'instituciones', 'description' => 'Modulo Instituciones', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'oferentes', 'description' => 'Modulo Oferentes', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'ciudadano', 'description' => 'Modulo Ciudadanos', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}