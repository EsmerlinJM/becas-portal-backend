<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->unsigned()->index()->references('id')->on('institutions');
            $table->foreignId('academic_offer_id')->unsigned()->index()->references('id')->on('academic_offers');
            $table->foreignId('schedule_id')->unsigned()->index()->references('id')->on('schedules');
            $table->foreignId('campus_id')->unsigned()->index()->references('id')->on('campuses');
            $table->text('justificacion')->nullable();
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
        Schema::dropIfExists('institution_offers');
    }
}