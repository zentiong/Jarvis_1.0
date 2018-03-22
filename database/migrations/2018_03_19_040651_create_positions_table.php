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
            $table->integer('job_grade')->unsigned();
            $table->foreign('job_grade')->references('id')->on('job_grades');
        });

        DB::table('positions')->insert(
        array(
            'name' => 'Developer',
            'job_grade' => '7'

        )  );

        DB::table('positions')->insert(
        array(
            'name' => 'HR Associate',
            'job_grade' => '9'

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
