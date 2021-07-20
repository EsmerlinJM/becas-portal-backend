<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('convocatoria_id')->unsigned()->index()->references('id')->on('convocatorias');
            $table->foreignId('convocatoria_detail_id')->unsigned()->index()->references('id')->on('convocatoria_details');
            $table->foreignId('candidate_id')->unsigned()->index()->references('id')->on('candidates');
            $table->foreignId('aplication_status_id')->unsigned()->index()->references('id')->on('aplication_statuses');
            $table->double('score', 8, 2)->nullable();
            $table->text('notes')->nullable();
            $table->boolean('closed')->default('0');
            $table->boolean('sent')->default('0');
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
        Schema::dropIfExists('aplications');
    }
}