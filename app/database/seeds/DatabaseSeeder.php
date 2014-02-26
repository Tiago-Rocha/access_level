<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('UtilizadorsTableSeeder');
		$this->call('CompaniesTableSeeder');
		$this->call('ClientsTableSeeder');
		$this->call('ContractsTableSeeder');
		$this->call('ServicereportsTableSeeder');
	}

}