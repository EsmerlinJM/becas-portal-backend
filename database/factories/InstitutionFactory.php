<?php

namespace Database\Factories;

use App\Models\Institution;
use App\Models\User;
use App\Models\InstitutionType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class InstitutionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Institution::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'institution_type_id' => InstitutionType::all()->random(),
            'siglas' => $this->faker->randomElement($array = array ('ABC','DCF','MIT','PCC','MXT','ITLA','UTE','APEC','AQX','GFT','GTER','GDKF','GTSK','ASDF','TREW','GDFS','AFGT','GDSA','HGTY','IOYP','JJDHF','OITX','LKSD','ASKG')),
            'name' => $this->faker->company,
            'image_url'         => $this->faker->imageUrl($width = 640, $height = 480),
            'image_ext'         => 'jpg',
            'image_size'        => '1024',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function universidad()
    {
        return $this->state(function (array $attributes) {
            return [
                'institution_type_id' => '1',
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function politecnico()
    {
        return $this->state(function (array $attributes) {
            return [
                'institution_type_id' => '2',
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function negocio()
    {
        return $this->state(function (array $attributes) {
            return [
                'institution_type_id' => '3',
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function itecnico()
    {
        return $this->state(function (array $attributes) {
            return [
                'institution_type_id' => '4',
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function idioma()
    {
        return $this->state(function (array $attributes) {
            return [
                'institution_type_id' => '5',
            ];
        });
    }
}