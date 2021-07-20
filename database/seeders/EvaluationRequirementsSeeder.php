<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EvaluationRequirementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('evaluation_requirements')->insert([
            [
                'evaluation_id' => '1',
                'name' => 'Documentacion',
                'description' => 'Descripcion de los Documentos Necesarios',
                'value' => '10.00',
                'step_basic' => '4.00',
                'step_medium' => '8.00',
                'step_complete' => '10.00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'evaluation_id' => '1',
                'name' => 'Historial Academico',
                'description' => 'Descripcion del historial Academico Necesario',
                'value' => '10.00',
                'step_basic' => '4.00',
                'step_medium' => '8.00',
                'step_complete' => '10.00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'evaluation_id' => '1',
                'name' => 'Criterio Adicional 1',
                'description' => 'Descripcion del Criterio Adicional 1',
                'value' => '10.00',
                'step_basic' => '4.00',
                'step_medium' => '8.00',
                'step_complete' => '10.00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'evaluation_id' => '1',
                'name' => 'Criterio Adicional 2',
                'description' => 'Descripcion del Criterio Adicional 2',
                'value' => '10.00',
                'step_basic' => '4.00',
                'step_medium' => '8.00',
                'step_complete' => '10.00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'evaluation_id' => '1',
                'name' => 'Criterio Adicional 3',
                'description' => 'Descripcion del Criterio Adicional 3',
                'value' => '10.00',
                'step_basic' => '4.00',
                'step_medium' => '8.00',
                'step_complete' => '10.00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'evaluation_id' => '1',
                'name' => 'Criterio Adicional 4',
                'description' => 'Descripcion del Criterio Adicional 4',
                'value' => '10.00',
                'step_basic' => '4.00',
                'step_medium' => '8.00',
                'step_complete' => '10.00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'evaluation_id' => '1',
                'name' => 'Criterio Adicional 5',
                'description' => 'Descripcion del Criterio Adicional 5',
                'value' => '10.00',
                'step_basic' => '4.00',
                'step_medium' => '8.00',
                'step_complete' => '10.00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'evaluation_id' => '1',
                'name' => 'Criterio Adicional 6',
                'description' => 'Descripcion del Criterio Adicional 6',
                'value' => '10.00',
                'step_basic' => '4.00',
                'step_medium' => '8.00',
                'step_complete' => '10.00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'evaluation_id' => '1',
                'name' => 'Criterio Adicional 7',
                'description' => 'Descripcion del Criterio Adicional 7',
                'value' => '10.00',
                'step_basic' => '4.00',
                'step_medium' => '8.00',
                'step_complete' => '10.00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'evaluation_id' => '1',
                'name' => 'Criterio Adicional 8',
                'description' => 'Descripcion del Criterio Adicional 8',
                'value' => '10.00',
                'step_basic' => '4.00',
                'step_medium' => '8.00',
                'step_complete' => '10.00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }

}