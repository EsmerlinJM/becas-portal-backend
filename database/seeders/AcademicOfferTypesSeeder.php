<?php

namespace Database\Seeders;

use App\Models\AcademicOfferType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AcademicOfferTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academic_offer_types')->insert([
            ['name' => 'Maestrias', 'created_at' => Carbon::now()],
            ['name' => 'PostGrados', 'created_at' => Carbon::now()],
            ['name' => 'Doctorados', 'created_at' => Carbon::now()],
            ['name' => 'Nivel Tecnico', 'created_at' => Carbon::now()],
        ]);
    }
}