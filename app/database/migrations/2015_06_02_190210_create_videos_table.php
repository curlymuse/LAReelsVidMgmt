<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVideosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::create('lrvm_videos', function(Blueprint $table) {
			$table->increments('id');
      $table->integer('vimeo_id')->unsigned();
      $table->string('title', 1024);
      $table->text('description');
      $table->boolean('is_published')->default(true);
      $table->boolean('is_ingested')->default(false);
      $table->softDeletes();
			$table->timestamps();
		});

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		Schema::drop('videos');

	}

}
