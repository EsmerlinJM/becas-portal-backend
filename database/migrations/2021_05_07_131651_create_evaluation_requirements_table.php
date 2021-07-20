<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('evaluation_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_id')->unsigned()->index()->references('id')->on('evaluations');
            $table->string('name');
            $table->string('description');
            $table->double('value', 8,2);
            $table->double('step_basic', 8, 2);
            $table->double('step_medium', 8, 2);
            $table->double('step_complete', 8, 2);
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
        Schema::dropIfExists('evaluation_requirements');
    }
}