<?php

namespace Database\Seeders;

use App\Models\Audience;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AudiencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('audiences')->insert([
            ['name' => 'Profesionales', 'created_at' => Carbon::now()],
            ['name' => 'Bachilleres', 'created_at' => Carbon::now()],
            ['name' => 'Estudiantes Activos', 'created_at' => Carbon::now()],
            ['name' => 'Todos', 'created_at' => Carbon::now()],
        ]);
    }
}
