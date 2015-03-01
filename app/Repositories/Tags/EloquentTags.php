<?php namespace Blog\Repositories\Tags;

//	Models
use Blog\Tags;

//	Other
use Config;

class EloquentTags implements TagsInterface {

	public function __construct(Tags $tags)
	{
		$this->tags = $tags;
	}

	public function all()
	{
		return $this->tags->has('posts')->get();
	}

	public function findByName($name)
	{
		return $this->tags->firstOrCreate(['name' => $name]);
	}

}