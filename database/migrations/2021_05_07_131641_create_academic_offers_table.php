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
            $table->foreignId('academic_offer_type_id')->unsigned()->index()->references('id')->on('academic_offer_types');
            $table->foreignId('education_level_id')->unsigned()->index()->references('id')->on('education_levels');
            //  Already defined on relationship with education level
            // $table->foreignId('development_area_id')->unsigned()->index()->references('id')->on('development_areas');
            $table->string('career');
            $table->string('duration');
            $table->string('language');
            $table->text('pensum');
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