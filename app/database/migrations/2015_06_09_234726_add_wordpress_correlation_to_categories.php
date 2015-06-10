<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddWordpressCorrelationToCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::table('lrvm_categories', function(Blueprint $table) {
            $table->integer('wordpress_category_id')->nullable();
		});

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		Schema::table('lrvm_categories', function(Blueprint $table) {
            $table->dropColumn('wordpress_category_id');
		});

	}

}
