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
            ['name' => 'admin', 'description' => 'Permisos Administrativos', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'create', 'description' => 'Permisos crear', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'edit', 'description' => 'Permisos editar', 'active' => '1', 'created_at' => Carbon::now()],
            ['name' => 'delete', 'description' => 'Permisos borrar', 'active' => '1', 'created_at' => Carbon::now()],
        ]);
    }
}