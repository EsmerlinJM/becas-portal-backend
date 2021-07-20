<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->unsigned()->index()->references('id')->on('countries');
            $table->foreignId('province_id')->unsigned()->index()->references('id')->on('provinces');
            $table->foreignId('municipality_id')->unsigned()->index()->references('id')->on('municipalities');
            $table->foreignId('institution_id')->unsigned()->index()->references('id')->on('institutions');
            $table->string('name');
            $table->string('address');
            $table->string('phone_number');
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
        Schema::dropIfExists('campuses');
    }
}