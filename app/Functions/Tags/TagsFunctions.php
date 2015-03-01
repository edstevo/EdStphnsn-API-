<?php namespace Blog\Functions\Tags;

use Blog\Repositories\Tags\TagsInterface;

class TagsFunctions {

	public function __construct(TagsInterface $tags)
	{
		$this->tags 	= $tags;
	}

	public function convertToIds($tags)
	{
		$ids 		= [];
		if (is_null($tags))
		{
			$ids 	= [];
		} else {

			foreach($tags as $tag)
			{
				array_push($ids, $this->tags->findByName($tag)->id);
			}
		}
		return $ids;
	}

}