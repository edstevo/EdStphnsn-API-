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
			->with(['creator', 'tags'])
			->where('type', $this->post_type)
			->where('draft', false)
			->select(['title','lat','lng'])
			->orderBy('created_at', 'DESC')
			->get();
	}

}