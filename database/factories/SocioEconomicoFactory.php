<?php

namespace Database\Factories;

use App\Models\SocioEconomico;
use App\Models\Candidate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class SocioEconomicoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SocioEconomico::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'candidate_id' => Candidate::factory(),
            'padre_nombre' => $this->faker->name($gender = 'male'),
            'padre_nivel_educativo'  => $this->faker->randomElement($array = array ('Sin estudios','Basico','Medio','Universitario')),
            'padre_trabaja'   => $this->faker->randomElement($array = array ('Si','No')),
            'padre_lugar_trabajo' => $this->faker->company,
            'padre_funcion_trabajo' => $this->faker->jobTitle,
            'padre_rango_salarial'  => $this->faker->randomElement($array = array ('RD$1-10000','RD$10000-20000','RD$20000- 30000','RD$30000-40000','Más de RD$50000')),
            'madre_nombre' => $this->faker->name($gender = 'female'),
            'madre_nivel_educativo' => $this->faker->randomElement($array = array ('Sin estudios','Basico','Medio','Universitario')),
            'madre_trabaja' => $this->faker->randomElement($array = array ('Si','No')),
            'madre_lugar_trabajo' => $this->faker->company,
            'madre_funcion_trabajo' => $this->faker->jobTitle,
            'madre_rango_salarial' => $this->faker->randomElement($array = array ('RD$1-10000','RD$10000-20000','RD$20000- 30000','RD$30000-40000','Más de RD$50000')),
            'pago_alquiler' => $this->faker->randomElement($array = array ('Si','No')),
            'monto_alquiler' => $this->faker->numberBetween($min = 10000, $max = 70000),
            'vehiculo_propio' => $this->faker->randomElement($array = array ('Si','No')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    /**
     * Asignado al candidato del ID 1
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function candidato()
    {
        return $this->state(function (array $attributes) {
            return [
                'candidate_id' => '1',
            ];
        });
    }
}
