<?php namespace Blog\Functions\Tags;

class TagsFunctions {

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