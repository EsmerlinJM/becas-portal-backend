<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\User;
use App\Models\Country;
use App\Models\Province;
use App\Models\Municipality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class CandidateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Candidate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $email = $this->faker->unique()->safeEmail;
        $user = new User();
        $user->role_id = 6;
        $user->email = $email;
        $user->email_verified_at = Carbon::now();
        $user->password = bcrypt('admin');
        $user->save();

        return [
            'user_id'           => $user->id,
            'country_id'        => Country::all()->random(),
            'province_id'       => Province::all()->random(),
            'municipality_id'   => Municipality::all()->random(),
            'document_id'       => $this->faker->creditCardNumber,
            'name'              => $this->faker->firstName,
            'last_name'          => $this->faker->lastName,
            'born_date'         => $this->faker->dateTimeBetween($startDate = '-40 years', $endDate = '-20 years', $timezone = null),
            'contact_phone'      => $this->faker->phoneNumber,
            'contact_email'     => $email,
            'address'           => $this->faker->streetAddress,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];
    }
}