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
            $table->string('description');
        });

        DB::table('skills')->insert(
        array(
            'name' => 'Math',
            'description' => 'Adding stuff'
        )  );

         DB::table('skills')->insert(
        array(
            'name' => 'Communication',
            'description' => 'Understanding others perspective'
        )  );

        DB::table('skills')->insert(
        array(
            'name' => 'Theology',
            'description' => 'God stuff'
        )  );

        DB::table('skills')->insert(
        array(
            'name' => 'People',
            'description' => 'Social Interaction'
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
