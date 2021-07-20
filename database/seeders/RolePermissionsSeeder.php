<?php

namespace Database\Seeders;

use App\Models\RolePermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_permissions')->insert([

            //Admin
            ['role_id' => '1', 'permission_id' => '1', 'created_at' => Carbon::now()],
            ['role_id' => '1', 'permission_id' => '2', 'created_at' => Carbon::now()],
            ['role_id' => '1', 'permission_id' => '3', 'created_at' => Carbon::now()],
            ['role_id' => '1', 'permission_id' => '4', 'created_at' => Carbon::now()],


            //Evaluators
            ['role_id' => '2', 'permission_id' => '2', 'created_at' => Carbon::now()],
            ['role_id' => '2', 'permission_id' => '3', 'created_at' => Carbon::now()],
            ['role_id' => '2', 'permission_id' => '4', 'created_at' => Carbon::now()],

            //Coordinators
            ['role_id' => '3', 'permission_id' => '2', 'created_at' => Carbon::now()],
            ['role_id' => '3', 'permission_id' => '3', 'created_at' => Carbon::now()],
            ['role_id' => '3', 'permission_id' => '4', 'created_at' => Carbon::now()],

            //IES
            ['role_id' => '4', 'permission_id' => '2', 'created_at' => Carbon::now()],
            ['role_id' => '4', 'permission_id' => '3', 'created_at' => Carbon::now()],
            ['role_id' => '4', 'permission_id' => '4', 'created_at' => Carbon::now()],

            //Offerers
            ['role_id' => '5', 'permission_id' => '2', 'created_at' => Carbon::now()],
            ['role_id' => '5', 'permission_id' => '3', 'created_at' => Carbon::now()],
            ['role_id' => '5', 'permission_id' => '4', 'created_at' => Carbon::now()],

            //Users
            ['role_id' => '6', 'permission_id' => '2', 'created_at' => Carbon::now()],
            ['role_id' => '6', 'permission_id' => '3', 'created_at' => Carbon::now()],
            ['role_id' => '6', 'permission_id' => '4', 'created_at' => Carbon::now()],

        ]);
    }
}