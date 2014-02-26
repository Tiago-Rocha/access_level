<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DropDurationServicereportsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('servicereports', function(Blueprint $table) {
            $table->dropColumn('duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::create('servicereports', function (Blueprint $table) {
            $table->float('duration');
        });
    }

}
