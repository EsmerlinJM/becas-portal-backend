<?php

namespace Database\Factories;

use App\Models\EducationLevel;
use App\Models\DevelopmentArea;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class EducationLevelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EducationLevel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'development_area_id'   => DevelopmentArea::all()->random(),
            'name'                  => $this->faker->randomElement($array = array ('Bachiller','Grado','PostGrado','Maestria','Doctorado')),
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ];
    }
}