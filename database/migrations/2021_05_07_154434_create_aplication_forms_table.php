<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAplicationFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplication_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aplication_id')->unsigned()->index()->references('id')->on('aplications');
            $table->foreignId('formulario_detail_id')->unsigned()->index()->references('id')->on('formulario_details');
            $table->text('answer')->nullable();
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
        Schema::dropIfExists('aplication_forms');
    }
}
