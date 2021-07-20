<?php

namespace Database\Factories;

use App\Models\ConvocatoriaDetail;
use App\Models\Convocatoria;
use App\Models\Institution;
use App\Models\Schedule;
use App\Models\Campus;
use App\Models\Offerer;
use App\Models\AcademicOffer;
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
        return [
            'convocatoria_id'   => Convocatoria::all()->random(),
            'institution_id'    => Institution::all()->random(),
            'campus_id'         => Campus::all()->random(),
            'academic_offer_id' => AcademicOffer::all()->random(),
            'offerer_id'        => Offerer::all()->random(),
            'schedule_id'       => Schedule::all()->random(),
            'coverage'          => $this->faker->numberBetween($min = 20, $max = 100),
            'image_url'         => $this->faker->imageUrl($width = 640, $height = 480),
            'image_ext'         => 'jpg',
            'image_size'        => '1024',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];
    }
}