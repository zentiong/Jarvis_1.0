<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('assessment_id')->unsigned();
            $table->foreign('assessment_id')->references('id')->on('assessments')->onDelete('cascade');

            $table->longText('criteria');

        });

        DB::table('assessment_items')->insert(
        array(
            'assessment_id' => '1',
            'criteria' => 'Grammar'
        )  );

        DB::table('assessment_items')->insert(
        array(
            'assessment_id' => '1',
            'criteria' => 'Pronunciation'
        )  );

        DB::table('assessment_items')->insert(
        array(
            'assessment_id' => '2',
            'criteria' => 'Empathy'
        )  );

        DB::table('assessment_items')->insert(
        array(
            'assessment_id' => '2',
            'criteria' => 'Warmth'
        )  );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessment_items');
    }
}
