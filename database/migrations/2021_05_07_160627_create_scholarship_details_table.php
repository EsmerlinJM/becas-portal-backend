<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScholarshipDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholarship_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scholarship_id')->unsigned()->index()->references('id')->on('scholarships');
            $table->foreignId('academic_offer_id')->unsigned()->index()->references('id')->on('academic_offers');
            $table->integer('max_rating');
            $table->integer('min_rating');
            $table->string('period');
            $table->double('rating');
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
        Schema::dropIfExists('scholarship_details');
    }
}