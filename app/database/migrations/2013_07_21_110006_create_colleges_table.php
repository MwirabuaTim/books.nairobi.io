<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCollegesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colleges', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->string('street');
			$table->string('city');
			$table->string('state');
			$table->string('postal_code');
			$table->integer('student_count');
			$table->biginteger('added_by');
			$table->integer('approved_by');
            $table->timestamps();
			$table->timestamp(' approved_at');
			$table->string('latitude');
			$table->string('longitude');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('colleges');
    }

}
