<?php namespace Blog\Http\Controllers;

use Blog\Http\Requests;
use Blog\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Response;

use Blog\Repositories\Tags\TagsInterface;

class TagController extends Controller {

	public function __construct(	TagsInterface $tags 	)
	{
		$this->tags 	= $tags;
	}

	public function index()
	{
		$tags 	= $this->tags->all();
		return Response::make(['data' => $tags], 200);
	}

	public function store()
	{
		//
	}

	public function show($id)
	{
		//
	}

	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

}
