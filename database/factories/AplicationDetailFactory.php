<?php

namespace Database\Factories;

use App\Models\Aplication;
use App\Models\AplicationDetail;
use App\Models\EvaluationRequirement;
use Illuminate\Database\Eloquent\Factories\Factory;

use Carbon\Carbon;

class AplicationDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AplicationDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $aplication = Aplication::all()->random();

        foreach ($aplication->convocatoria_detail->convocatoria->evaluation->requirements as $item) {
            return [
                'aplication_id'                 => $aplication->id,
                'evaluation_requirement_id'     => $item->id,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ];
        }

    }
}