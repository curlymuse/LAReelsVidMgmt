<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('lrvm_users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('password', 100);
            $table->string('remember_token', 100)->nullable();
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

        Schema::drop('lrvm_users');

    }

}
