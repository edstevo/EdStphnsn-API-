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

	public function execute($has_code, $listener)
	{
		if (!$has_code)
		{
			return $this->getAuthorizationFirst();
		}

		$user 	= Socialise::with('facebook')->user();
		$user 	= $this->user->findByEmailOrCreate($user->getEmail());

		$this->auth->login($user, true);

		return $listener->userHasLoggedIn($user);
	}

	private function getAuthorizationFirst()
	{
		return Socialise::with('facebook')->redirect();
	}

}