<?php

namespace Database\Factories;

use App\Models\Aplication;
use App\Models\ConvocatoriaDetail;
use App\Models\Candidate;
use App\Models\AplicationStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Aplication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $detalle = ConvocatoriaDetail::all()->random();
        return [
            'convocatoria_id'           => $detalle->convocatoria->id,
            'convocatoria_detail_id'    => $detalle->id,
            'offerer_id'                => $detalle->offerer->id,
            'institution_id'            => $detalle->oferta->institution->id,
            'candidate_id'              => Candidate::all()->random(),
            'aplication_status_id'      => 1, //Solicitud Enviada
            'score'                     => $this->faker->randomElement($array = array ('10','20','30','40','50')),
            'sent'                      => $this->faker->randomElement($array = array (true,false)),
            'created_at'                => Carbon::now(),
            'updated_at'                => Carbon::now(),
        ];
    }
}
