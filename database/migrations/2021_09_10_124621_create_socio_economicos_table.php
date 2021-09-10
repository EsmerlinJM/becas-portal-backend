<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocioEconomicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socio_economicos', function (Blueprint $table) {
            $table->id();
            $table->integer('candidate_id');
            $table->string('padre_nombre')->nullable();
            $table->enum('padre_nivel_educativo', ['Sin estudios','Basico','Medio','Universitario'])->nullable();
            $table->enum('padre_trabaja', ['Si','No'])->nullable();
            $table->string('padre_lugar_trabajo')->nullable();
            $table->string('padre_funcion_trabajo')->nullable();
            $table->string('padre_rango_salarial')->nullable();
            $table->string('madre_nombre')->nullable();
            $table->enum('madre_nivel_educativo', ['Sin estudios','Basico','Medio','Universitario'])->nullable();
            $table->enum('madre_trabaja', ['Si','No'])->nullable();
            $table->string('madre_lugar_trabajo')->nullable();
            $table->string('madre_funcion_trabajo')->nullable();
            $table->string('madre_rango_salarial')->nullable();
            $table->enum('pago_alquiler', ['Si','No'])->nullable();
            $table->float('monto_alquiler')->nullable();
            $table->enum('vehiculo_propio', ['Si','No'])->nullable();
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
        Schema::dropIfExists('socio_economicos');
    }
}
