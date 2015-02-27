<?php namespace Blog\Providers;

use Blog\User;
use Blog\Repositories\User\EloquentUser;

use Blog\Posts;
use Blog\Repositories\Blog\EloquentBlog;
use Blog\Repositories\Posts\EloquentPosts;
use Blog\Repositories\Travel\EloquentTravel;

use Blog\Comments;
use Blog\Repositories\Comments\EloquentComments;

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

		$this->app->bind('Blog\Repositories\Blog\BlogInterface', function($app) {
			return new EloquentBlog(new Posts);
		});

		$this->app->bind('Blog\Repositories\Posts\PostsInterface', function($app) {
			return new EloquentPosts(
				new Posts,
				$this->app->make('Blog\Functions\Posts\PostsFunctions')
			);
		});

		$this->app->bind('Blog\Repositories\Travel\TravelInterface', function($app) {
			return new EloquentTravel(new Posts);
		});

		$this->app->bind('Blog\Repositories\Comments\CommentsInterface', function($app) {
			return new EloquentComments(new Comments);
		});

		$this->app->bind('Blog\Repositories\User\UserInterface', function($app) {
			return new EloquentUser(new User);
		});

	}

}
