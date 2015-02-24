<?php namespace Blog\Providers;

use Blog\User;
use Blog\Repositories\User\EloquentUser;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {

		//	User Repository
		$this->app->bind('Blog\Repositories\User\UserInterface', function($app) {
			return new EloquentUser(new User);
		});

	}

}
