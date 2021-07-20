<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ConvocatoriaTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('convocatoria_types')->insert([
            ['name' => 'Nacionales', 'color' => '#00A2FF', 'created_at' => Carbon::now()],
            ['name' => 'Internacionales', 'color' => '#ED232A', 'created_at' => Carbon::now()],
            ['name' => 'Lenguas', 'color' => '#7BB31A', 'created_at' => Carbon::now()],
        ]);
    }
}