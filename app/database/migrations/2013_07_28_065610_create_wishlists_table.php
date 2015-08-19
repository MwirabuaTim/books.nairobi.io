<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWishlistsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Wishlists', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->integer('collegeid');
			$table->string('name');
			$table->string('author');
            $table->string('query');
            $table->string('bookurl');
            $table->string('imgurl');
            $table->string('publishdate');
            $table->string('binding');
            $table->string('isbn');
            $table->string('newprice');
            $table->string('usedprice');
            $table->string('price');
            $table->string('largeimg');
			$table->timestamp('deleted_at');
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
        Schema::drop('Wishlists');
    }

}
