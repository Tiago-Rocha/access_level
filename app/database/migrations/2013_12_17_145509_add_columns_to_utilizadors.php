<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddColumnsToUtilizadors extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('utilizadors', function(Blueprint $table) {
                    $table->boolean('contractmanager');
                    $table->boolean('networkmanager');
                    $table->string('mobile_pro');
                    $table->string('mobile_priv');
                    $table->string('phone_pro');
                    $table->string('phone_priv');
                    $table->string('extension');
                    $table->string('address');
                    $table->string('comments');                    
                    $table->boolean('active');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
		Schema::table('utilizadors', function (Blueprint $table){
                    $table->dropColumn('contractmanager');
                    $table->dropColumn('networkmanager');
                    $table->dropColumn('mobile_pro');
                    $table->dropColumn('mobile_priv');
                    $table->dropColumn('phone_pro');
                    $table->dropColumn('phone_priv');
                    $table->dropColumn('extension');
                    $table->dropColumn('address');
                    $table->dropColumn('comments');                    
                    $table->dropColumn('active');
                });
	}

}