<?php namespace Blog\Functions\Auth;

use Illuminate\Contracts\Auth\Guard;
use Blog\Repositories\User\UserInterface;

use Socialise;

class AuthenticateUser {

	private $auth, $socialise, $user;

	public function __construct(	Guard $auth,
									Socialise $socialise,
									UserInterface $user 	)
	{
		$this->auth 		= $auth;
		$this->socialise 	= $socialise;
		$this->user 		= $user;
	}

	public function execute($has_code)
	{
		if (!$has_code)
		{
			return $this->getAuthorizationFirst();
		}

		$user 	= Socialise::with('twitter')->user();
		$user 	= $this->user->findByEmailOrCreate($user->getEmail());

		return $this->auth->login($user, true);
	}

	private function getAuthorizationFirst()
	{
		return Socialise::with('twitter')->redirect();
	}

}