<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Notificacion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class NotificacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notificacion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'       => User::all()->random(),
            'name'          => $this->faker->catchPhrase,
            'description'   => $this->faker->text($maxNbChars = 200),
            'read'          => $this->faker->boolean,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ];
    }
}