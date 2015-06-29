<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWordpressColumnsToPodcasts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

        Schema::table('lrvm_podcasts', function(Blueprint $table) {
            $table->integer('wordpress_post_id')->nullable()->after('is_published');
            $table->datetime('synced_at')->nullable()->after('is_published');
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

        Schema::table('lrvm_podcasts', function(Blueprint $table) {
            $table->dropColumn('wordpress_post_id');
            $table->dropColumn('synced_at');
        });

	}

}
