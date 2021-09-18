<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MensajesConvocatoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mensajes_convocatorias')->insert([
            [
                'name' => 'Mensajes Base',
                'iniciada' => 'Mensajes de Solicitud Iniciada',
                'aprobada' => 'Mensajes de Solicitud Aprobada',
                'rechazada' => 'Mensajes de Solicitud rechazada',
                'evaluacion' => 'Mensajes de Solicitud en evaluacion',
                'credito' => 'Mensajes de Solicitud Aprobada credito educativo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()],
        ]);
    }
}
