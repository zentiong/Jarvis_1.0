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
            $table->string('description', 1000);
            //logo
            $table->string('logo', 255)->nullable();
            //link
            $table->string('link', 255);
        });

        DB::table('links')->insert(
        array(
            'service_id' => '1',
            'title' => 'On-boarding/ Off-boarding Request for Interns and NFTEs',
            'description' => 'For activation and deactivation of email accounts and access to tools of Interns and NFTEs.',
            'link' => 'https://www.google.com',
            'logo' => 'key.png'
        )  );

        DB::table('links')->insert(
        array(
            'service_id' => '1',
            'title' => 'Intern Request',
            'description' => 'Manpower request for interns.[Department Heads Only]',
            'link' => 'https://www.google.com',
            'logo' => 'intern-request.png'
        )  );

        DB::table('links')->insert(
        array(
            'service_id' => '1',
            'title' => 'Jobs Board',
            'description' => 'Click to see here our current job openings locally and regionally.',
            'link' => 'https://www.google.com',
            'logo' => 'jobs-board.png'
        )  );

        DB::table('links')->insert(
        array(
            'service_id' => '1',
            'title' => 'Headcount Request',
            'description' => 'Manpower request for FTEs, On-calls, and Internal Mobility.[Department Heads Only]',
            'link' => 'https://www.google.com',
            'logo' => 'headcount-request.png'
        )  );

        DB::table('links')->insert(
        array(
            'service_id' => '1',
            'title' => 'NFTE Request',
            'description' => 'For agency hiring needs.[Department Heads Only]',
            'link' => 'https://www.google.com',
            'logo' => 'nfte-request.png'
        )  );

        DB::table('links')->insert(
        array(
            'service_id' => '2',
            'title' => 'Change in Schedule Request',
            'description' => 'For issues affecting compensation:
            Unrecorded overtime
            Misrecorded undertime
            Misrecorded absences',
            'link' => 'https://www.google.com',
            'logo' => 'change-in-schedule.png'
        )  );

        DB::table('links')->insert(
        array(
            'service_id' => '2',
            'title' => 'Certificate of Employment Request',
            'description' => ' Document to prove employement in ZALORA.[For FTEs only]',
            'link' => 'https://www.google.com',
            'logo' => 'coe-request.png'
        )  );



        DB::table('links')->insert(
        array(
            'service_id' => '3',
            'title' => '201 Request',
            'description' => 'For requesting a copy of any of the following:
            Job contract
            Pre-employement requirements
            Evaluations
            Memos from the company',
            'link' => 'https://www.google.com',
            'logo' => 'folder.png'
        )  );

        DB::table('links')->insert(
        array(
            'service_id' => '3',
            'title' => 'Return to Work Order Form',
            'description' => 'Form to be filled to call back to work an employee who was absent for 2 consecutive days without prior notice.',
            'link' => 'https://www.google.com',
            'logo' => 'return-to-work.png'
        )  );

        DB::table('links')->insert(
        array(
            'service_id' => '4',
            'title' => 'Shuttle Request',
            'description' => 'For shuttle service requests. Requests should be made 2-3 days in advance.',
            'link' => 'https://www.google.com',
            'logo' => 'microbus.png'
        )  );
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
