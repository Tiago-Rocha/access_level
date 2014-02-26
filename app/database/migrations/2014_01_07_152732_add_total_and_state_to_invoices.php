<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTotalAndStateToInvoices extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('i_invoices', function(Blueprint $table) {
			$table->float('total');
                        $table->enum('state', array('created','sent','paid','archived'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('i_invoices', function(Blueprint $table) {
		    $table->dropColumn('total');                    
                    $table->dropColumn('state');
		});
	}

}
