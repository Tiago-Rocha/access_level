<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSoftdeletes extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('clients', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('companies', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('contracts', function(Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

    }

}
