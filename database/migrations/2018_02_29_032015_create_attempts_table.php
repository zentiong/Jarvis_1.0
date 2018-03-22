<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            // user quiz

            $table->integer('section_attempt_id')->unsigned();
            $table->foreign('section_attempt_id')->references('id')->on('section_attempts');

            
            // question id

            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('questions');


            // attempts

            $table->string('answer_attempt', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attempts');
    }
}
