<?php

namespace Database\Factories;

use App\Models\InstitutionOffer;
use App\Models\Institution;
use App\Models\AcademicOffer;
use App\Models\Campus;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class InstitutionOfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InstitutionOffer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'institution_id' => Institution::all()->random(),
            'academic_offer_id' => AcademicOffer::all()->random(),
            'campus_id' => Campus::all()->random(),
            'schedule_id'       => Schedule::all()->random(),
            'justificacion'       => $this->faker->text($maxNbChars = 400),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}