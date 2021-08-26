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
            'convocatoria_detail_id' => $solicitud->convocatoria_detail->id,
            'offerer_id' => $solicitud->offerer->id,
            'institution_id' => $solicitud->institution->id,
            'institution_offer_id' => $solicitud->convocatoria_detail->oferta->id,
            'aplication_id' => $solicitud->id,
            'candidate_id' => $solicitud->candidate->id,
            'name' => $solicitud->candidate->name,
            'lastname' => $solicitud->candidate->last_name,
            'genero'    => $solicitud->candidate->genero,
            'estado'    => $this->faker->randomElement($array = array ('egresado','retirado','expulsado','activo','suspendido')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}