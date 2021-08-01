<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordinatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unsigned()->index()->references('id')->on('users');
            $table->string('image_url')->nullable();
            $table->string('image_ext')->nullable();
            $table->string('image_size')->nullable();
            $table->string('name');
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
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
        Schema::dropIfExists('coordinators');
    }
}