<?php

namespace Database\Factories;

use App\Models\Campus;
use App\Models\Country;
use App\Models\Province;
use App\Models\Municipality;
use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class CampusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Campus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country_id'        => Country::all()->random(),
            'province_id'       => Province::all()->random(),
            'municipality_id'   => Municipality::all()->random(),
            'institution_id'    => Institution::all()->random(),
            'name'              => $this->faker->state(),
            'address'           => $this->faker->address(),
            'phone_number'      => $this->faker->phoneNumber(),
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];
    }
}