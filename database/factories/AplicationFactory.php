<?php

namespace Database\Factories;

use App\Models\Aplication;
use App\Models\ConvocatoriaDetail;
use App\Models\Candidate;
use App\Models\AplicationStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Aplication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'convocatoria_detail_id' => ConvocatoriaDetail::all()->random(),
            'candidate_id'           => Candidate::all()->random(),
            'aplication_status_id'   => AplicationStatus::all()->random(),
            'created_at'             => Carbon::now(),
            'updated_at'             => Carbon::now(),
        ];
    }
}