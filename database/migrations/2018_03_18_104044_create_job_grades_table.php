<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_grades', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('knowledge_based_weight')->default(50);
            $table->integer('skills_based_weight')->default(50);
        });

        DB::table('job_grades')->insert(
        array(
            'id' => '1',
            'knowledge_based_weight' => '80',
            'skills_based_weight' => '20'

        )  );

        DB::table('job_grades')->insert(
        array(
            'id' => '2',
            'knowledge_based_weight' => '75',
            'skills_based_weight' => '25'

        )  );

        DB::table('job_grades')->insert(
        array(
            'id' => '3',
            'knowledge_based_weight' => '70',
            'skills_based_weight' => '30'

        )  );

        DB::table('job_grades')->insert(
        array(
            'id' => '4',
            'knowledge_based_weight' => '65',
            'skills_based_weight' => '35'

        )  );

        DB::table('job_grades')->insert(
        array(
            'id' => '5',
            'knowledge_based_weight' => '60',
            'skills_based_weight' => '40'

        )  );

        DB::table('job_grades')->insert(
        array(
            'id' => '6',
            'knowledge_based_weight' => '55',
            'skills_based_weight' => '45'

        )  );

        DB::table('job_grades')->insert(
        array(
            'id' => '7',
            'knowledge_based_weight' => '50',
            'skills_based_weight' => '50'

        )  );

        DB::table('job_grades')->insert(
        array(
            'id' => '8',
            'knowledge_based_weight' => '45',
            'skills_based_weight' => '55'

        )  );

        DB::table('job_grades')->insert(
        array(
            'id' => '9',
            'knowledge_based_weight' => '40',
            'skills_based_weight' => '60'

        )  );

        DB::table('job_grades')->insert(
        array(
            'id' => '10',
            'knowledge_based_weight' => '35',
            'skills_based_weight' => '65'

        )  );

        DB::table('job_grades')->insert(
        array(
            'id' => '11',
            'knowledge_based_weight' => '30',
            'skills_based_weight' => '70'

        )  );

        DB::table('job_grades')->insert(
        array(
            'id' => '12',
            'knowledge_based_weight' => '25',
            'skills_based_weight' => '75'

        )  );

        DB::table('job_grades')->insert(
        array(
            'id' => '13',
            'knowledge_based_weight' => '20',
            'skills_based_weight' => '80'

        )  );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_grades');
    }
}
