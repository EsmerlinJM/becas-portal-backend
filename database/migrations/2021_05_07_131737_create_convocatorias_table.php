<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvocatoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocatorias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coordinator_id')->unsigned()->index()->references('id')->on('coordinators');
            $table->foreignId('convocatoria_type_id')->unsigned()->index()->references('id')->on('convocatoria_types');
            $table->foreignId('mensajes_convocatoria_id')->unsigned()->index()->references('id')->on('mensajes_convocatorias');
            $table->foreignId('evaluation_id')->unsigned()->index()->references('id')->on('evaluations');
            $table->foreignId('audience_id')->unsigned()->index()->references('id')->on('audiences');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('image_url')->nullable();
            $table->string('image_ext')->nullable();
            $table->string('image_size')->nullable();
            $table->boolean('published')->default(0);
            $table->enum('status', ['Pendiente', 'Abierta','Cerrada']);
            $table->text('requisitos')->nullable();
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
        Schema::dropIfExists('convocatorias');
    }
}