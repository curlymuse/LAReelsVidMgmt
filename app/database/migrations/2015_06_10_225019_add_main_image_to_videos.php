<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMainImageToVideos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::table('lrvm_videos', function(Blueprint $table) {
            $table->string('main_image_url', 256)->after('thumbnail_url');
		});

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		Schema::table('lrvm_videos', function(Blueprint $table) {
			$table->dropColumn('main_image_url');
		});
	}

}
