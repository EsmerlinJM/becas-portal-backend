<?php

namespace Database\Factories;

use App\Models\ConvocatoriaDetail;
use App\Models\Convocatoria;
use App\Models\Formulario;
use App\Models\InstitutionOffer;
use App\Models\Schedule;
use App\Models\Offerer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ConvocatoriaDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConvocatoriaDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $convocatoria = Convocatoria::all()->random();
        $offer = InstitutionOffer::all()->random();
        return [
            'convocatoria_id'   => $convocatoria->id,
            'institution_offer_id'    => $offer->id,
            'formulario_id'     => Formulario::all()->random(),
            'institution_id'    => $offer->institution->id,
            'offerer_id'        => Offerer::all()->random(),
            'schedule_id'       => Schedule::all()->random(),
            'evaluation_id'     => $convocatoria->evaluation->id,
            'coverage'          => $this->faker->numberBetween($min = 20, $max = 100),
            'image_url'         => $this->faker->imageUrl($width = 640, $height = 480),
            'image_ext'         => 'jpg',
            'image_size'        => '1024',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];
    }
}