<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNewFieldsToVideos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::table('lrvm_videos', function(Blueprint $table) {
            $table->dropColumn('is_ingested');
            $table->integer('wordpress_post_id')->nullable();
            $table->dateTime('synced_at')->nullable()->default(null);
		});

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		Schema::table('lrvm_videos', function(Blueprint $table) {
            $table->dropColumn('wordpress_post_id');
            $table->dropColumn('synced_at');
            $table->boolean('is_ingested')->default(false);
		});
	}

}
