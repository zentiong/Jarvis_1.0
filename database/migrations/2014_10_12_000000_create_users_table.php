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


            $table->boolean('manager_check', 255)->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        /*Informal Seed*/

        DB::table('users')->insert(
        array(
            'first_name' => 'Quin',
            'last_name' => 'Tech',
            'email' => 'qt@qt.com',
            'password' => bcrypt('asdasd'),
            'hiring_date' => '2018-12-31',
            'birth_date' => '2018-12-31',
            'department' => 'Administration',
            'supervisor_id' => '1',
            'position' => 'Administrator',
            'manager_check' => 1

        )  );

        DB::table('users')->insert(
        array(
            'first_name' => 'Anferny',
            'last_name' => 'Vanta',
            'email' => 'vantanferny@gmail.com',
            'password' => bcrypt('1'),
            'hiring_date' => '2018-12-31',
            'birth_date' => '2018-12-31',
            'department' => 'Customer Service',
            'supervisor_id' => '3', 
            'position' => 'Back End Developer',
            'manager_check' => 0
        ));   

         DB::table('users')->insert(
        array(
            'first_name' => 'Zen',
            'last_name' => 'Tiongson',
            'email' => 'zt@zt.com',
            'password' => bcrypt('1'),
            'hiring_date' => '2018-12-31',
            'birth_date' => '2018-12-31',
            'department' => 'Information Technology',
            'supervisor_id' => '1', 
            'position' => 'Project Manager',
            'manager_check' => 1
        ));   

         DB::table('users')->insert(
        array(
            'first_name' => 'Stephen',
            'last_name' => 'Wenceslao',
            'email' => 'sw@sw.com',
            'password' => bcrypt('1'),
            'hiring_date' => '2018-12-31',
            'birth_date' => '2018-12-31',
            'department' => 'Human Resources',
            'supervisor_id' => '3', 
            'position' => 'Front End Developer',
            'manager_check' => 0
        ));   

         DB::table('users')->insert(
        array(
            'first_name' => 'Vince',
            'last_name' => 'Agbayani',
            'email' => 'va@va.com',
            'password' => bcrypt('1'),
            'hiring_date' => '2018-12-31',
            'birth_date' => '2018-12-31',
            'department' => 'Marketing',
            'supervisor_id' => '3', 
            'position' => 'Back End Marketer',
            'manager_check' => 0
        ));   




  
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
