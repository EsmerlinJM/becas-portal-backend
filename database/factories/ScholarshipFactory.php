<?php

namespace Database\Factories;

use App\Models\Scholarship;
use App\Models\Candidate;
use App\Models\Aplication;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ScholarshipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Scholarship::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $solicitud = Aplication::all()->random();
        return [
            'convocatoria_id' => $solicitud->convocatoria->id,
            'candidate_id' => $solicitud->candidate->id,
            'aplication_id' => $solicitud->id,
            'name' => $this->faker->name,
            'lastname1' => $this->faker->lastName,
            'lastname2' => $this->faker->lastName,
            'genero'    => $solicitud->candidate->genero,
            'estado'    => $this->faker->randomElement($array = array ('egresado','retirado','expulsado','activo','suspendido')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}