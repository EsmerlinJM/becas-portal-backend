<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMensajesConvocatoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('convocatorias', function (Blueprint $table) {
            $table->integer('mensajes_convocatoria_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('convocatorias', function (Blueprint $table) {
            $table->dropColumn('mensajes_convocatoria_id');
        });
    }
}