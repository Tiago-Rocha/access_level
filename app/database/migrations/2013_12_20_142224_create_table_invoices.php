<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableInvoices extends Migration {
    /*
     * N foi migrado ainda!!!
     * Ver apontamentos para perceber as 3 tabelas.
     */

/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('i_invoices', function(Blueprint $table) {
                        $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
                        $table->date('start');
			$table->date('end');
                        $table->date('date');
			$table->date('due_date');
			$table->string('structure');
			$table->string('tva');
			$table->integer('company_id')->unsigned();
			$table->timestamps();
		});		
                Schema::create('i_invoice_template', function(Blueprint $table) {
                        $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->string('uns_address');
			$table->string('company_address');
			$table->string('tva_num');
			$table->string('conditions');
			$table->string('footer');
			$table->integer('invoice_id')->unsigned();
			$table->timestamps();
		});		
                Schema::create('i_invoice_content', function(Blueprint $table) {
                        $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->string('code');
			$table->string('description');
			$table->float('quantity');
			$table->float('price_unit');
			$table->integer('invoice_id')->unsigned();
                        $table->timestamps();
		});
	}
// Invoice Sections
//http://stackoverflow.com/questions/10057480/creating-an-invoice-using-phpmysql
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('i_invoice_content');
                Schema::drop('i_invoice_template');
                Schema::drop('i_invoices');
	}

}