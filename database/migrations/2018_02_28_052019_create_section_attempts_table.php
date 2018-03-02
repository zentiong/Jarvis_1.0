<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_attempts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            // User Quiz

            $table->integer('user_quiz_id')->unsigned();
            $table->foreign('user_quiz_id')->references('id')->on('user_quiz');

            // Section

            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections');

            // Score

            $table->integer('score')->default(0);
            $table->integer('max_score')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_attempts');
    }
}
