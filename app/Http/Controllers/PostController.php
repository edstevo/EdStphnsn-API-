<?php namespace Blog\Http\Controllers;

use Blog\Http\Requests;
use Blog\Http\Requests\StorePostRequest;
use Blog\Http\Requests\UpdatePostRequest;
use Blog\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Response;

use Log;

use Blog\Repositories\Posts\PostsInterface;
use Blog\Functions\Posts\PostsFunctions;
use Blog\Repositories\User\UserInterface;

class PostController extends Controller {

	public function __construct(	Guard $auth,
									PostsInterface $posts,
									PostsFunctions $post_functions,
									UserInterface $user 	)
	{
		$this->auth 			= $auth;
		$this->posts 			= $posts;
		$this->post_functions 	= $post_functions;
		$this->user 			= $user;
	}

	public function index()
	{
		$all_posts	= $this->user->getPosts($this->auth->user());
		return Response::make(['data'	=> $all_posts], 200);
	}

	public function draftPosts()
	{
		$draft_posts	= $this->user->getDraftPosts($this->auth->user());
		return Response::make(['data'	=> $draft_posts], 200);
	}

	public function store(StorePostRequest $request)
	{
		$post			= $this->posts->updateOrCreate($request->only('id', 'title', 'type', 'draft', 'content'));
		$post->content 	= $this->post_functions->removeLinks($post->content);
		return Response::make(['data'	=> $post], 200);
	}

	public function show($post_id)
	{
		$post			= $this->posts->find($post_id);
		$post->content 	= $this->post_functions->removeLinks($post->content);
		return Response::make(['data'	=> $post], 200);
	}

	public function update(UpdatePostRequest $request, $post_id)
	{
		$post			= $this->posts->update($post_id, $request->only('title', 'type', 'draft', 'content'));
		$post->content 	= $this->post_functions->removeLinks($post->content);
		return Response::make(['data'	=> $post], 200);
	}

	public function destroy($post_id)
	{
		//
	}

}
