<?php namespace Blog\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

use Blog\Repositories\User\UserInterface;

class Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(	Guard $auth,
									UserInterface $user	)
	{
		$this->auth = $auth;
		$this->user = $user;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		preg_match('/Basic\s+(.*)$/i', $request->header('Authorization'), $auth_header);
		$username 	= base64_decode($auth_header[1]);
		$username	= str_replace(":", "", $username);

		$user 		= $this->user->findByUsernameOrCreate($username);

		$this->auth->login($user);

		return $next($request);
	}

}
