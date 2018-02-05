<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('email')->unique();
            $table->string('password');

            $table->date('hiring_date', 255);
            $table->date('birth_date', 255);

            $table->string('department', 255);
            $table->string('supervisor_id', 255);
            $table->string('position', 255);

            $table->boolean('manager_check', 255)->nullable();;

            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
        array(
            'first_name' => 'Quin',
            'last_name' => 'Tech',
            'email' => 'qt@qt.com',
            'password' => bcrypt('asdasd'),
            'hiring_date' => '2018-12-31',
            'birth_date' => '2018-12-31',
            'department' => '1',
            'supervisor_id' => '1',
            'position' => '1'

        )
    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
