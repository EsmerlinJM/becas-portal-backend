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
            ['name' => 'Medicina', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Leyes', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Tecnologia', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Mercadeo', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Mecanica', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Fisica Aplicada', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Biologia & Quimica', 'active' => '1', 'created_at' => Carbon::now()],
        ]);
    }
}