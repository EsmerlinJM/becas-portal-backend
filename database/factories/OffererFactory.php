<?php

namespace Database\Factories;

use App\Models\Offerer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class OffererFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offerer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'document_id' => $this->faker->creditCardNumber,
            'type' => $this->faker->randomElement($array = array ('Empresa Privada','Fundacion','ONG','Embajada','Figura Publica','Empresario')),
            'contact_person' => $this->faker->name,
            'contact_number' => $this->faker->phoneNumber,
            'contact_email' => $this->faker->email,
            'image_url'         => $this->faker->imageUrl($width = 640, $height = 480),
            'image_ext'         => 'jpg',
            'image_size'        => '1024',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}