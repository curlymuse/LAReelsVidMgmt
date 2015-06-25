<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDurationColumnToPodcasts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

        Schema::table('lrvm_podcasts', function(Blueprint $table) {
            $table->string('duration');
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

        Schema::table('lrvm_podcasts', function(Blueprint $table) {
            $table->dropColumn('duration');
        });

	}

}
