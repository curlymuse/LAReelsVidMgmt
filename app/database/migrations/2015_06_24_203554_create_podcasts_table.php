<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePodcastsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

        Schema::create('lrvm_podcasts', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('episode_number')->index();
            $table->string('title');
            $table->string('filename');
            $table->text('description');
            $table->boolean('is_published');
            $table->timestamps();
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

        Schema::drop('lrvm_podcasts');

	}

}
