<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RoleModulosSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_modulos')->insert([

            //Admin
            ['role_id' => '1', 'modulo_id' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['role_id' => '1', 'modulo_id' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['role_id' => '1', 'modulo_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['role_id' => '1', 'modulo_id' => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['role_id' => '1', 'modulo_id' => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['role_id' => '1', 'modulo_id' => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            //Evaluators
            ['role_id' => '2', 'modulo_id' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            //Coordinators
            ['role_id' => '3', 'modulo_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            //INSTITUCIONES
            ['role_id' => '4', 'modulo_id' => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            //OFERENTES
            ['role_id' => '5', 'modulo_id' => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            //Users
            ['role_id' => '6', 'modulo_id' => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}