<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajeBackOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensaje_back_offices', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('candidate_id');
            $table->string('subject');
            $table->text('message');
            $table->boolean('read')->default(0);
            $table->enum('type', ['enviado','recibido']);
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
        Schema::dropIfExists('mensaje_back_offices');
    }
}