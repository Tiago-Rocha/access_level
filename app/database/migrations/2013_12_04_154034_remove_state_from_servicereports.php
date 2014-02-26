<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveStateFromServicereports extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('servicereports', function(Blueprint $table) {
            $table->dropColumn('state');
            $table->dropColumn('choices');
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
