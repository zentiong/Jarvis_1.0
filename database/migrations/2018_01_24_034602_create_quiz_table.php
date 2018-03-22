<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('quiz_id');
            $table->timestamps();
            $table->string('topic', 255);
            $table->string('password', 255);
            $table->integer('training_id')->unsigned();
            $table->foreign('training_id')->references('id')->on('trainings');

            
            
        });
        /*
        DB::table('quizzes')->insert(
        array(
            'topic' => 'Communication',
            'skill_id' => '2'
        )  );

        DB::table('quizzes')->insert(
        array(
            'topic' => 'Customer Relations',
            'skill_id' => '4'
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
        Schema::dropIfExists('quizzes');
    }
}
