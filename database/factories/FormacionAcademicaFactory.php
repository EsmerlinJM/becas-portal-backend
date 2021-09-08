<?php

namespace Database\Factories;

use App\Models\FormacionAcademica;
use App\Models\Candidate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class FormacionAcademicaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FormacionAcademica::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $actual = null;
        return [
            'candidate_id'   => Candidate::all()->random(),
            'carrera'        => $this->faker->jobTitle,
            'institucion' => $this->faker->company,
            'isBecado' => $this->faker->boolean,
            'fecha_entrada' => Carbon::now()->subYears(10),
            'fecha_salida' => $this->faker->randomElement($array = array ($actual,Carbon::now())),
            'indice' => $this->faker->numberBetween($min = 1, $max = 4),
            'certificacion_url' => 'https://storage.googleapis.com/tdoc_do-001/2021-06-02-SIGLAS-LOGO-1622687948.PDF',
            'certificacion_ext' => 'pdf',
            'certificacion_size' => '1024',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ];
    }
}