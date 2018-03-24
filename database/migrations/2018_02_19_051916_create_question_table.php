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

            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections');

            $table->string('question_item', 255);
            $table->string('answer_item', 255);

            $table->string('choice_1', 255);
            $table->string('choice_2', 255);
            $table->string('choice_3', 255);
            $table->string('choice_4', 255);
        });
        /*
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
        */
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
