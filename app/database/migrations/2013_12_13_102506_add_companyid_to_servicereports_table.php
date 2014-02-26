<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCompanyidToServicereportsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('servicereports', function(Blueprint $table) {
            $table->integer('company_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::drop('servicereports', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });
    }

}
