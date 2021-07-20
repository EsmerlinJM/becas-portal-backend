<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FormularioDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('formulario_details')->insert([
            [
                'formulario_id' => 1,
                'type'  => 'text',
                'required' => true,
                'name' => 'Aplicacion',
                'description' => 'Porque esta aplicando para esta beca',
                'data' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'formulario_id' => 1,
                'type'  => 'textarea',
                'required' => true,
                'name' => 'Motivacion',
                'description' => 'Cuales son sus motivaciones para solicitar esta beca',
                'data' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'formulario_id' => 1,
                'type'  => 'checkbox',
                'required' => true,
                'name' => 'Idiomas',
                'description' => 'Cuales idiomas de este listado maneja',
                'data' => "['Ingles','Frances','Aleman','Español']",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'formulario_id' => 1,
                'type'  => 'radio',
                'required' => true,
                'name' => 'Nivel Academico',
                'description' => 'Cual es su nivel Academico',
                'data' => "['Grado','PostGrado','Maestria','Nivel Tecnico','Bachiller']",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'formulario_id' => 1,
                'type'  => 'select',
                'required' => true,
                'name' => 'Carrera',
                'description' => 'A cual de estas carreras pertenece',
                'data' => "['Medicina','Leyes','Agronomia','Contabilidad','Arquitectura']",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'formulario_id' => 1,
                'type'  => 'date',
                'required' => true,
                'name' => 'Graduacion',
                'description' => 'Fecha graduacion',
                'data' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'formulario_id' => 1,
                'type'  => 'file',
                'required' => true,
                'name' => 'Certificado Bachiller',
                'description' => 'Suba el certificado de Bachiller en formato PDF',
                'data' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'formulario_id' => 1,
                'type'  => 'file',
                'required' => true,
                'name' => 'Certificado Universitario',
                'description' => 'Suba el certificado de graduacion de carrera en formato PDF',
                'data' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'formulario_id' => 1,
                'type'  => 'number',
                'required' => true,
                'name' => 'Tiempo Carrera',
                'description' => 'Cuantos años hace de finalizar su ultima carrera?',
                'data' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}