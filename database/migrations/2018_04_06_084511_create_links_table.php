<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services');

            //title
            $table->string('title', 255);
            //description
            $table->string('description', 255);
            //logo
            $table->string('logo', 255)->nullable();
            //link
            $table->string('link', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
}
