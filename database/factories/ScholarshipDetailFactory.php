<?php

namespace Database\Factories;

use App\Models\Scholarship;
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
        $beca = Scholarship::all()->random();
        return [
            'scholarship_id' => $beca->id,
            'convocatoria_id' => $beca->convocatoria->id,
            'convocatoria_detail_id' => $beca->convocatoria_detail->id,
            'offerer_id' => $beca->offerer->id,
            'institution_id' => $beca->institution->id,
            'institution_offer_id' => $beca->institution_offer->id,
            'candidate_id' => $beca->candidate->id,
            'aplication_id' => $beca->aplication->id,
            'min_rating' => $min_rating,
            'max_rating' => $max_rating,
            'period' => $this->faker->randomElement(['T1-2021','T2-2021','T3-2021','T4-2021','T1-2022','T2-2022','T3-2022','T4-2022']),
            'rating' => $this->faker->numberBetween($min = $min_rating, $max = $max_rating),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}