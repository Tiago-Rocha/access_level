<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddColumnsToCompanies extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('companies', function(Blueprint $table) {
                    $table->string('zip_code');
                    $table->string('address');
                    $table->string('country');
                    $table->string('tva_rate');
                    $table->string('vat_number');
                    $table->string('iban');
                    $table->string('bic');
                    $table->string('general_phone');
                    $table->string('genral_fax');
                    $table->string('comment');
                    $table->boolean('active');
                    $table->string('hardware_delivery_fee');
                    $table->string('toners_delivery_fee');
                    $table->string('out_of_contract');
                    $table->string('travel_expenses');
                    $table->integer('due_days');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
		Schema::table('companies', function (Blueprint $table){
                    $table->dropColumn('zip_code');
                    $table->dropColumn('address');
                    $table->dropColumn('country');
                    $table->dropColumn('tva_rate');
                    $table->dropColumn('vat_number');
                    $table->dropColumn('iban');
                    $table->dropColumn('bic');
                    $table->dropColumn('general_phone');
                    $table->dropColumn('genral_fax');
                    $table->dropColumn('comment');
                    $table->dropColumn('active');
                    $table->dropColumn('hardware_delivery_fee');
                    $table->dropColumn('toners_delivery_fee');
                    $table->dropColumn('out_of_contract');
                    $table->dropColumn('travel_expenses');
                    $table->dropColumn('due_days');
                });
	}

}