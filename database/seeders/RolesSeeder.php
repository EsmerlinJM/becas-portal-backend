<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Admin', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Evaluador', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Coordinador', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Institucion', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Ofertante', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'Usuario', 'active' => '1', 'created_at' => Carbon::now()],
        ]);
    }
}