<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUploadedAtToVideos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::table('lrvm_videos', function(Blueprint $table) {
            $table->timestamp('uploaded_at')->nullable();
		});

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		Schema::table('lrvm_videos', function(Blueprint $table) {
            $table->dropColumn('uploaded_at');
		});
	}

}
