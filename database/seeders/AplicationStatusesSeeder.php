<?php

namespace Database\Seeders;

use App\Models\AplicationStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AplicationStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aplication_statuses')->insert([
            ['name' => 'Solicitud Enviada', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'En proceso de evaluacion', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'En proceso de revision', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Preseleccionado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Incompleto', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Aprobado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Aprobado con prioridad alta', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Declinado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Cancelada por Candidato', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
