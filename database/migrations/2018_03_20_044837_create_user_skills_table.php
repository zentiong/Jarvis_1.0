<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_skills', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('skill_id')->unsigned();
            $table->foreign('skill_id')->references('id')->on('skills');

            // goods

            $table->integer('q_score')->default(0);
            $table->integer('q_max_score')->default(0);

            $table->integer('knowledge_based_weight')->default(0);

            // on-going

            $table->integer('a_score')->default(0); 
            $table->integer('a_max_score')->default(0);

            $table->integer('skills_based_weight')->default(0);

            // grade

            $table->decimal('skill_grade')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_skills');
    }
}


