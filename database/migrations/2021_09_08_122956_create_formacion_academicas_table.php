<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormacionAcademicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formacion_academicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->unsigned()->index()->references('id')->on('candidates');
            $table->string('carrera');
            $table->string('institucion');
            $table->boolean('isBecado')->default(false);
            $table->date('fecha_entrada');
            $table->date('fecha_salida')->nullable();
            $table->string('indice');
            $table->string('certificacion_url')->nullable();
            $table->string('certificacion_ext')->nullable();
            $table->string('certificacion_size')->nullable();
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
        Schema::dropIfExists('formacion_academicas');
    }
}