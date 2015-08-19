<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourselistsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courselists', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
			$table->integer('courseid');
			$table->string('username');
			$table->string('coursename');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('courselists');
    }

}
