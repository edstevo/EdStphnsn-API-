<?php namespace Blog\Providers;

use Illuminate\Support\ServiceProvider;

use Blog\Posts;
use Blog\Observers\PostsObserver;

class ObserverServiceProvider extends ServiceProvider
{

	/**
	 * Bootstrap any necessary services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Posts::observe(new PostsObserver(
				$this->app->make('Illuminate\Contracts\Auth\Guard')
			)
		);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
	}

}