<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajesConvocatoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes_convocatorias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('iniciada')->nullable();
            $table->text('aprobada')->nullable();
            $table->text('rechazada')->nullable();
            $table->text('evaluacion')->nullable();
            $table->text('credito')->nullable();
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
        Schema::dropIfExists('mensajes_convocatorias');
    }
}
