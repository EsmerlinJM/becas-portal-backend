<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offerers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('document_id');
            $table->string('type');
            $table->string('contact_person');
            $table->string('contact_number');
            $table->string('contact_email');
            $table->string('image_url')->nullable();
            $table->string('image_ext')->nullable();
            $table->string('image_size')->nullable();
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
        Schema::dropIfExists('offerers');
    }
}