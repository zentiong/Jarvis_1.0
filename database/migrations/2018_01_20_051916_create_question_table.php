<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('quiz_id')->unsigned();
            $table->foreign('quiz_id')->references('quiz_id')->on('quizzes');
            $table->string('question_item', 255);
            $table->string('answer_item', 255);
        });

        DB::table('questions')->insert(
        array(
            'quiz_id' => '1',
            'question_item' => '2 + 2',
            'answer_item' => '4'
        )  );

        DB::table('questions')->insert(
        array(
            'quiz_id' => '1',
            'question_item' => '4 - 1',
            'answer_item' => '3'
        )  );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
