<?php

namespace Database\Factories;

use App\Models\ExperienciaLaboral;
use App\Models\Candidate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ExperienciaLaboralFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExperienciaLaboral::class;

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
            'empresa'        => $this->faker->company,
            'posicion' => $this->faker->JobTitle,
            'telefono' => $this->faker->phoneNumber,
            'tipo_contrato' => $this->faker->randomElement($array = array ('Fijo','Temporal','Indefinido')),
            'fecha_entrada' => Carbon::now()->subYears(10),
            'fecha_salida' => $this->faker->randomElement($array = array ($actual,Carbon::now())),
            'documento_url' => 'https://storage.googleapis.com/tdoc_do-001/2021-06-02-SIGLAS-LOGO-1622687948.PDF',
            'documento_ext' => 'pdf',
            'documento_size' => '1024',
            'rango_salarial' => $this->faker->randomElement($array = array ('RD$1-10000','RD$10000-20000','RD$20000- 30000','RD$30000-40000','Más de RD$50000')),
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ];
    }
}
