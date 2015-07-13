<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSourceFieldToPodcastHits extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

        Schema::table('lrvm_podcast_hits', function(Blueprint $table) {
            $table->string('source')->after('ip');
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

        Schema::table('lrvm_podcast_hits', function(Blueprint $table) {
            $table->dropColumn('source');
        });

	}

}
