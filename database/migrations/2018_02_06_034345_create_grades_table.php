<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_assessment_id')->unsigned();
            $table->foreign('user_assessment_id')->references('id')->on('user_assessments');

            $table->integer('assessment_item_id')->unsigned();
            $table->foreign('assessment_item_id')->references('id')->on('assessment_items');

            $table->integer('grade')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
