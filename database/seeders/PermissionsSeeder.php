<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'read', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'create', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'assign', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'publish', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'unpublish', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}