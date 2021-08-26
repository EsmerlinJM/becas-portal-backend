<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionEvaluatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_evaluators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluator_id')->unsigned()->index()->references('id')->on('evaluators');
            $table->foreignId('institution_id')->unsigned()->index()->references('id')->on('institutions');
            $table->foreignId('convocatoria_id')->unsigned()->index()->references('id')->on('institutions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institution_evaluators');
    }
}
