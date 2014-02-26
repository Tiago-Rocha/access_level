<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddStateToServicereportsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('servicereports', function(Blueprint $table) {
            $table->enum('state', array('submitted', 'validated', 'invoiced'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('servicereports', function(Blueprint $table) {
            
        });
    }

}
