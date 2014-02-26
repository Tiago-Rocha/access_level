<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUtilizadorsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('utilizadors', function(Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->boolean('admin');
            $table->boolean('humanresource');
            $table->boolean('servicereport');
            $table->boolean('clientmanager');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('utilizadors');
    }

}
