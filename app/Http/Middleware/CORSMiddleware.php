<?php namespace Blog\Http\Middleware;

use Closure;
use Response;
use Log;

class CORSMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$headers = [
			'Access-Control-Allow-Origin'      => '*',
			'Access-Control-Allow-Methods'     => 'DELETE, GET, POST, PUT, OPTIONS',
			'Access-Control-Allow-Headers'     => 'Origin, Content-Type, Accept, Authorization, X-Requested-With',
			'Access-Control-Allow-Credentials' => 'true'
		];

		if($request->getMethod() == "OPTIONS")
		{
			return Response::make(null, 204, $headers);
		}

		$response = $next($request);

		foreach($headers as $key => $value)
		{
			$response->headers->set('Access-Control-Allow-Origin', '*');
		}

		return $response;
	}

}
