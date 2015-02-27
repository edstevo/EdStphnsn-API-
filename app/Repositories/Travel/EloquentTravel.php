<?php namespace Blog\Repositories\Travel;

//	Models
use Blog\Posts;

//	Other
use Config;

class EloquentTravel implements TravelInterface {

	public function __construct(Posts $posts)
	{
		$this->posts 		= $posts;
		$this->post_type	= Config::get('constants.post_types.travel');
	}

	public function all()
	{
		return $this->posts
			->where('type', $this->post_type)
			->where('draft', false)
			->get();
	}

}