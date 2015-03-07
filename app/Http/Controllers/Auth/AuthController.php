<?php namespace Blog\Http\Controllers\Auth;

use Blog\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Response;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	public function __construct(	Guard $auth,
									Registrar $registrar	)
	{
		$this->auth 				= $auth;
		$this->registrar 			= $registrar;
	}

	public function adminCheck(Request $request)
	{
		$user_data	= $this->auth->user();
		return Response::make(['data' => $user_data], 200);
	}

}
