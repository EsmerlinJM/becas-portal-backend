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
            ['name' => 'admin', 'description' => 'Role Administrador', 'created_at' => Carbon::now()],
            ['name' => 'evaluador', 'description' => 'Role Evaluador', 'created_at' => Carbon::now()],
            ['name' => 'coordinador', 'description' => 'Role Coordinador', 'created_at' => Carbon::now()],
            ['name' => 'institucion', 'description' => 'Role Institucion', 'created_at' => Carbon::now()],
            ['name' => 'oferente', 'description' => 'Role Oferente', 'created_at' => Carbon::now()],
            ['name' => 'usuario', 'description' => 'Role Usuario', 'created_at' => Carbon::now()],
        ]);
    }
}