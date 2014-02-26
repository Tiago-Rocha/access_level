<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGlobalvarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('global_vars', function(Blueprint $table) {
                        $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
                        $table->string('short_name');
			$table->string('name');
                        $table->string('place');
			$table->string('address');
			$table->string('zip_code');
			$table->string('city');
                        $table->string('country');
			
                        $table->string('mail');
			$table->string('phone');
			$table->string('fax');
			$table->string('website');
                        
			$table->string('account_number');
			$table->string('bic');
			$table->string('iban');
			$table->string('vat_rate');
			$table->string('vat_number');
                        
			$table->string('conditions');
			$table->string('policy');
			$table->string('pdf_directory');
			$table->string('default_due_days');
			$table->timestamps();
		});
		//
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('global_vars');
	}

}