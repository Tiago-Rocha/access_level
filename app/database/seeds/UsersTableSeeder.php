<?php
class UsersTableSeeder extends Seeder {

	public function run() {
            DB::table('utilizadors')->delete();
        $user = new User;

        $user->fill(array(
        	'username' => 'lol',
                'admin' => '1',
                'humanresource' => '0',
                'servicereport' => '0',
        	'clientmanager'	=> '0'
        	));

       	$user->password = Hash::make('lol');

       	$user->save();
        
        }
}