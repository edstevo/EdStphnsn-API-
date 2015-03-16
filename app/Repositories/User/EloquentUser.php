<?php namespace Blog\Repositories\User;

//	Models
use Blog\User;

class EloquentUser implements UserInterface {

	public function __construct(User $user)
	{
		$this->user 	= $user;
	}

	public function findByUsernameOrCreate($username)
	{
		return $this->user->firstOrCreate([
				'username'	=> $username
			]);
	}

	public function getPosts($user)
	{
		return $this->user->find($user->id)
						->posts()
						->orderBy('created_at', 'DESC')
						->get();
	}

	public function getDraftPosts($user)
	{
		return $this->user->find($user->id)
						->posts()
						->where('draft', true)
						->orderBy('updated_at', 'DESC')
						->get();
	}

}