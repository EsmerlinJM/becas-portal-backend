<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvocatoriaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocatoria_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('convocatoria_id')->unsigned()->index()->references('id')->on('convocatorias');
            $table->foreignId('institution_offer_id')->unsigned()->index()->references('id')->on('institution_offers');
            $table->foreignId('offerer_id')->unsigned()->index()->references('id')->on('offerers');
            $table->foreignId('schedule_id')->unsigned()->index()->references('id')->on('schedules');
            $table->foreignId('evaluation_id')->unsigned()->index()->references('id')->on('evaluations');
            $table->foreignId('formulario_id')->unsigned()->index()->references('id')->on('formularios');
            $table->integer('coverage');
            $table->string('image_url')->nullable();
            $table->string('image_ext')->nullable();
            $table->string('image_size')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convocatoria_details');
    }
}
