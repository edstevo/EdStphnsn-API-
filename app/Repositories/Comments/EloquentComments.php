<?php namespace Blog\Repositories\Comments;

//	Models
use Blog\Comments;

class EloquentComments implements CommentsInterface {

	public function __construct(Comments $comments)
	{
		$this->comments 	= $comments;
	}

}