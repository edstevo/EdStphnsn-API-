<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		$user = Blog\User::create(array(
			'firstname'				=> 'Ed',
			'lastname'				=> 'Stephenson',
			'email'					=> 'edward.stephenson@me.com',
		));

	}

}