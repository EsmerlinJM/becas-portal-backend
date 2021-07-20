<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unsigned()->index()->references('id')->on('users');
            $table->foreignId('country_id')->unsigned()->index()->references('id')->on('countries');
            $table->foreignId('province_id')->unsigned()->index()->references('id')->on('provinces');
            $table->foreignId('municipality_id')->unsigned()->index()->references('id')->on('municipalities');
            $table->string('document_id')->nullable();
            $table->string('name');
            $table->string('last_name');
            $table->date('born_date')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('candidates');
    }
}