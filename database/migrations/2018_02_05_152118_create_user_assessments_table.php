<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('users');

            $table->integer('supervisor_id')->unsigned();
            $table->foreign('supervisor_id')->references('id')->on('users');

            $table->integer('assessment_id')->unsigned();
            $table->foreign('assessment_id')->references('id')->on('assessments');

            $table->float('rating')->default(0);

            $table->longText('feedback')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_assessments');
    }
}
