<?php

namespace Database\Factories;

use App\Models\Scholarship;
use App\Models\AcademicOffer;
use App\Models\ScholarshipDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ScholarshipDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ScholarshipDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $min_rating = $this->faker->numberBetween($min = 0, $max = 50);
        $max_rating = $this->faker->numberBetween($min = $min_rating+1, $max = 100);
        return [
            'scholarship_id' => Scholarship::all()->random(),
            'academic_offer_id' => AcademicOffer::all()->random(),
            'min_rating' => $min_rating,
            'max_rating' => $max_rating,
            'period' => $this->faker->randomElement(['T1-2021','T2-2021','T3-2021','T4-2021','T1-2022','T2-2022','T3-2022','T4-2022']),
            'rating' => $this->faker->numberBetween($min = $min_rating, $max = $max_rating),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
