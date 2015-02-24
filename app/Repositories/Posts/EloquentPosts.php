<?php namespace Blog\Repositories\Posts;

//	Models
use Blog\Posts;

class EloquentPosts implements PostsInterface {

	public function __construct(Posts $posts)
	{
		$this->posts 	= $posts;
	}

}