<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('date');
            $table->time('starting_time');
            $table->time('ending_time');
            $table->string('title', 255);
            $table->string('speaker', 255);
            $table->string('venue', 255);
        });
        
        DB::table('trainings')->insert(
        array(
            'date' => '2018-5-12',
            'starting_time' => '18:00:00 ',
            'ending_time' => '20:00:00 ',
            'title' => 'Welcome to the Dark Side',
            'speaker' => 'The Dark Lorde',
            'venue' => 'Singapore'
        )  );
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainings');
    }
}
