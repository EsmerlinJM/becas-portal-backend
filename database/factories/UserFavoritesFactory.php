<?php

namespace Database\Factories;

use App\Models\UserFavorites;
use App\Models\User;
use App\Models\ConvocatoriaDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class UserFavoritesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserFavorites::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random(),
            'convocatoria_detail_id' => ConvocatoriaDetail::all()->random(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}