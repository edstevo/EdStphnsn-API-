<?php namespace Blog\Repositories\User;

//	Models
use Blog\User;

class EloquentUser implements UserInterface {

	public function __construct(User $user)
	{
		$this->user 	= $user;
	}

	public function findByEmailOrCreate($user_email)
	{
		return $this->user->firstOrCreate([
				'email'	=> $user_email
			]);
	}

}