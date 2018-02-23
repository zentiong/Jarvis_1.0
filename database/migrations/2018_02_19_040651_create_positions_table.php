<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->integer('knowledge_based_weight');
            $table->integer('skills_based_weight');
        });

        DB::table('positions')->insert(
        array(
            'name' => 'Developer',
            'knowledge_based_weight' => '50',
            'skills_based_weight' => '50',

        )  );

        DB::table('positions')->insert(
        array(
            'name' => 'HR Associate',
            'knowledge_based_weight' => '50',
            'skills_based_weight' => '50',

        )  );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
    }
}
