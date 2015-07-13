<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePodcastDownloadTrackingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

        Schema::create('lrvm_podcast_hits', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('podcast_id')->unsigned()->index();
            $table->foreign('podcast_id')->references('id')->on('lrvm_podcasts');
            $table->string('ip');
            $table->timestamps();
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

        Schema::table('lrvm_podcast_hits', function(Blueprint $table) {
            $table->dropForeign('lrvm_podcast_hits_podcast_id_foreign');
        });

        Schema::drop('lrvm_podcast_hits');

	}

}
