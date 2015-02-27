<?php namespace Blog\Functions\Posts;

class TagFunctions {

	public function __construct()
	{

	}

	public function convertToIds($tags)
	{
		$ids 	= [];
		foreach($tags as $tag)
		{
			array_push($ids, $this->tag->findByName($tag));
		}
		return $ids;
	}

}