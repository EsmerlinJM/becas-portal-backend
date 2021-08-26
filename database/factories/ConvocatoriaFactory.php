<?php

namespace Database\Factories;

use App\Models\ConvocatoriaType;
use App\Models\Convocatoria;
use App\Models\Coordinator;
use App\Models\Audience;
use App\Models\Evaluation;
use App\Models\Formulario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ConvocatoriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Convocatoria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $convocatoriaDate = $this->faker->dateTimeBetween($startDate = '-20 years', $endDate = 'now', $timezone = 'America/Santo_Domingo');

        return [
            'coordinator_id' => Coordinator::all()->random(),
            'convocatoria_type_id' => ConvocatoriaType::all()->random(),
            'audience_id'   => Audience::all()->random(),
            'evaluation_id'     => Evaluation::all()->random(),
            'name'          => 'Convocatoria '.$this->faker->randomElement($array = array ('Becas Lenguas 2020','Becas Internacionales 2020','Becas Nacionales 2020','Becas Investigacion 2021')),
            'start_date'    => $convocatoriaDate,
            'end_date'      => $this->faker->dateTimeBetween($startDate = $convocatoriaDate, $endDate = '+5 years', $timezone = 'America/Santo_Domingo'),
            'status'            => $this->faker->randomElement($array = array ('Pendiente','Cerrada','Abierta')),
            'image_url'         => $this->faker->imageUrl($width = 640, $height = 480),
            'image_ext'         => 'jpg',
            'image_size'        => '1024',
            'published'           => $this->faker->boolean,
            'requisitos'       => $this->faker->randomHtml(2,3),
            // 'requisitos'       => $this->faker->paragraphs($nb = 15, $nbSentences = 15),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ];
    }
}