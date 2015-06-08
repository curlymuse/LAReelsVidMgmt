<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPublicRemovePublishedVideos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::table('lrvm_videos', function(Blueprint $table) {
            $table->dropColumn('is_published');
            $table->boolean('is_public')->default(true);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		Schema::table('lrvm_videos', function(Blueprint $table) {
            $table->dropColumn('is_public');
            $table->boolean('is_published')->default(true);
		});
	}

}
