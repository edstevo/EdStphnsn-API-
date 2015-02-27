<?php namespace Blog\Repositories\Blog;

//	Models
use Blog\Posts;

//	Other
use Config;

class EloquentBlog implements BlogInterface {

	public function __construct(Posts $posts)
	{
		$this->posts 		= $posts;
		$this->post_type	= Config::get('constants.post_types.blog');
	}

	public function all($skip = null)
	{
		return $this->posts
			->with('creator')
			->where('type', $this->post_type)
			->where('draft', false)
			->orderBy('created_at', 'DESC')
			->skip($skip)
			->take(10)
			->get();
	}

	public function latest()
	{
		return $this->posts
			->with('creator')
			->where('type', $this->post_type)
			->where('draft', false)
			->orderBy('created_at', 'DESC')
			->take(5)
			->get();
	}

}