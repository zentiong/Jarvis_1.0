<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
        });

        DB::table('skills')->insert(
        array(
            'name' => 'Math Skills'
        )  );

         DB::table('skills')->insert(
        array(
            'name' => 'Communication Skills'
        )  );

        DB::table('skills')->insert(
        array(
            'name' => 'Theology Skills'
        )  );

        DB::table('skills')->insert(
        array(
            'name' => 'People Skills'
        )  );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skills');
    }
}
