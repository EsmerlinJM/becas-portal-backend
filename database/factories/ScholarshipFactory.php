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
        return [
            'candidate_id' => Candidate::all()->random(),
            'aplication_id' => Aplication::all()->random(),
            'name' => $this->faker->name,
            'lastname1' => $this->faker->lastName,
            'lastname2' => $this->faker->lastName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}