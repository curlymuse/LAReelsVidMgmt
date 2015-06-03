<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

        Schema::create('lrvm_categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean('is_published')->default(true);
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

        Schema::drop('lrvm_categories');

	}

}
