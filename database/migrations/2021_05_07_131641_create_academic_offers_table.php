<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->unsigned()->index()->references('id')->on('institutions');
            $table->foreignId('academic_offer_type_id')->unsigned()->index()->references('id')->on('academic_offer_types');
            $table->foreignId('education_level_id')->unsigned()->index()->references('id')->on('education_levels');
            $table->text('detalles')->nullable();
            $table->string('career');
            $table->string('duration');
            $table->string('language');
            $table->integer('creditos')->nullable();
            $table->string('esfuerzo')->nullable();
            $table->float('costo')->nullable();
            $table->string('pensum_url')->nullable();
            $table->string('pensum_ext')->nullable();
            $table->string('pensum_size')->nullable();
            $table->boolean('active');
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
        Schema::dropIfExists('academic_offers');
    }
}