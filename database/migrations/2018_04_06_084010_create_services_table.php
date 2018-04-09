<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name', 255);
        });

         DB::table('services')->insert(
        array(
            'name' => 'RECRUITMENT',
        )  );

         DB::table('services')->insert(
        array(
            'name' => 'COMPENSATION & BENEFITS',
        )  );

         DB::table('services')->insert(
        array(
            'name' => 'EMPLOYEE RELATIONS',
        )  );

         DB::table('services')->insert(
        array(
            'name' => 'ADMIN',
        )  );




    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
