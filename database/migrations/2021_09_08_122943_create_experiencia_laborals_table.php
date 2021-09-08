<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienciaLaboralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencia_laborals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->unsigned()->index()->references('id')->on('candidates');
            $table->string('empresa');
            $table->string('posicion');
            $table->string('telefono');
            $table->string('tipo_contrato');
            $table->date('fecha_entrada');
            $table->date('fecha_salida')->nullable();
            $table->string('documento_url')->nullable();
            $table->string('documento_ext')->nullable();
            $table->string('documento_size')->nullable();
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
        Schema::dropIfExists('experiencia_laborals');
    }
}