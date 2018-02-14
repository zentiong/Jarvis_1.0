<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('topic', 255);

            $table->integer('skill_id')->unsigned();
            $table->foreign('skill_id')->references('id')->on('skills');
        });

        DB::table('assessments')->insert(
        array(
            'topic' => 'Communication',
            'skill_id' => '2'
        )  );

        DB::table('assessments')->insert(
        array(
            'topic' => 'Customer Relations',
            'skill_id' => '4'
        )  );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessments');
    }
}
