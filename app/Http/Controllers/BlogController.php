<?php namespace Blog\Http\Controllers;

use Blog\Http\Requests;
use Blog\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Response;

use Blog\Repositories\Blog\BlogInterface;
use Blog\Repositories\Posts\PostsInterface;

class BlogController extends Controller {

	public function __construct(	BlogInterface $blog,
									PostsInterface $posts 	)
	{
		$this->blog 	= $blog;
		$this->posts 	= $posts;
	}

	public function index($skip = null)
	{
		$all_posts 	= $this->blog->all($skip);
		return Response::make(['data' => $all_posts], 200);
	}

	public function show($post_id)
	{
		$post 	= $this->posts->find($post_id);
		return Response::make(['data' => $post], 200);
	}

	public function latest()
	{
		$latest_posts 	= $this->blog->latest();
		return Response::make(['data' => $latest_posts], 200);
	}

}
