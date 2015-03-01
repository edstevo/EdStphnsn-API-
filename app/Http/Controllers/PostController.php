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
use Blog\Repositories\User\UserInterface;

use Blog\Functions\Posts\PostsFunctions;
use Blog\Functions\Tags\TagsFunctions;

class PostController extends Controller {

	public function __construct(	Guard $auth,
									PostsInterface $posts,
									PostsFunctions $post_functions,
									TagsFunctions $tags_functions,
									UserInterface $user 	)
	{
		$this->auth 			= $auth;
		$this->posts 			= $posts;
		$this->post_functions 	= $post_functions;
		$this->tags_functions 	= $tags_functions;
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
		$tags 			= $this->tags_functions->convertToIds($request->get('tags'));
		$sync_tags 		= $this->posts->syncTags($post->id, $tags);

		return $this->show($post->id);
	}

	public function show($post_id)
	{
		$post				= $this->posts->find($post_id);
		$return				= json_decode($post->toJson());
		$return->tags 		= $post->tags->lists('name');
		$return->content 	= $this->post_functions->removeLinks($post->content);
		return Response::make(['data'	=> $return], 200);
	}

	public function update(UpdatePostRequest $request, $post_id)
	{
		$post			= $this->posts->update($post_id, $request->only('title', 'type', 'draft', 'content'));
		$tags 			= $this->tags_functions->convertToIds($request->get('tags'));
		$sync_tags 		= $this->posts->syncTags($post->id, $tags);

		return $this->show($post->id);
	}

	public function destroy($post_id)
	{
		//
	}

}
