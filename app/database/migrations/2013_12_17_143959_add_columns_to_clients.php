<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddColumnsToClients extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clients', function(Blueprint $table) {
                    $table->string('surname');
                    $table->string('function');
                    $table->string('email');
                    $table->string('phone');
                    $table->string('mobile');
                    $table->string('lang');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
		Schema::table('clients', function (Blueprint $table){
                    $table->dropColumn('surname');
                    $table->dropColumn('function');
                    $table->dropColumn('email');
                    $table->dropColumn('phone');
                    $table->dropColumn('mobile');
                    $table->dropColumn('lang');
                });
	}

}