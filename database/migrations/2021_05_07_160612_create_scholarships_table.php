<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScholarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('convocatoria_id')->unsigned()->index()->references('id')->on('convocatorias');
            $table->foreignId('candidate_id')->unsigned()->index()->references('id')->on('candidates');
            $table->foreignId('aplication_id')->unsigned()->index()->references('id')->on('aplications');
            $table->string('name');
            $table->string('lastname1');
            $table->string('lastname2');
            $table->enum('genero', ['masculino','femenino']);
            $table->enum('estado', ['egresado','retirado','expulsado','activo','suspendido']);
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
        Schema::dropIfExists('scholarships');
    }
}