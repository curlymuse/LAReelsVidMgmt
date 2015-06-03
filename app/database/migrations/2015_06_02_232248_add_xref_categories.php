<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddXrefCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

        Schema::create('lrvm_videos_categories', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->unsigned()->index();
            $table->foreign('video_id')->references('id')->on('lrvm_videos');
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('lrvm_categories');
            $table->timeStamps();
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

        Schema::table('lrvm_videos_categories', function(Blueprint $table) {
            $table->dropForeign('lrvm_videos_categories_video_id_foreign');
            $table->dropForeign('lrvm_videos_categories_category_id_foreign');
        });

        Schema::drop('lrvm_videos_categories');

	}

}
