<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormularioDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulario_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formulario_id')->unsigned()->index()->references('id')->on('formularios');
            $table->foreignId('formulario_seccion_id')->unsigned()->index()->references('id')->on('formulario_seccions');
            $table->enum('type', ['text','textarea','checkbox','radio','select','date','file','number']);
            $table->boolean('required')->default(0);
            $table->string('name');
            $table->string('description');
            $table->text('data')->nullable(); //AQUI IRIA LA DATA, EN FORMATO DE UN JSON PARA ENTREGAR A FRONTEND
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
        Schema::dropIfExists('formulario_details');
    }
}
