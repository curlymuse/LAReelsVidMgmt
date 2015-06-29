<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEpisodeImageColumnToPodcasts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

        Schema::table('lrvm_podcasts', function(Blueprint $table) {
            $table->string('episode_image')->after('description')->nullable();
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

        Schema::table('lrvm_podcasts', function(Blueprint $table) {
            $table->dropColumn('lrvm_podcasts');
        });

	}

}
