<?php

namespace Database\Seeders;

use App\Models\InstitutionType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InstitutionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institution_types')->insert([
            ['name' => 'Universidad', 'created_at' => Carbon::now()],
            ['name' => 'Politecnico', 'created_at' => Carbon::now()],
            ['name' => 'Escuela de Negocios', 'created_at' => Carbon::now()],
            ['name' => 'Instituto Tecnico', 'created_at' => Carbon::now()],
            ['name' => 'Escuela de Idiomas', 'created_at' => Carbon::now()],
        ]);
    }
}
