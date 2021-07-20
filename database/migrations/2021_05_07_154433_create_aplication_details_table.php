<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAplicationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplication_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aplication_id')->unsigned()->index()->references('id')->on('aplications');
            $table->foreignId('evaluation_requirement_id')->unsigned()->index()->references('id')->on('evaluation_requirements');
            $table->integer('evaluator_id')->nullable()->unsigned();
            $table->double('score', 8, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('evaluated_at')->nullable();
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
        Schema::dropIfExists('aplication_details');
    }
}