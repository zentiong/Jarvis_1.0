<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('training_id')->unsigned();
            $table->foreign('training_id')->references('id')->on('trainings');
            $table->boolean('recommended')->default(false);
            $table->boolean('confirmed')->default(false);

            $table->longText('evaluation')->nullable();
            $table->integer('rating_training')->nullable();
            $table->integer('rating_speaker')->nullable();

            //$table->boolean('attended')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_trainings');
    }
}
