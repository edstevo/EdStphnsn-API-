<?php namespace Blog\Repositories\Posts;

//	Models
use Blog\Posts;

//	Other
use Config;

class EloquentPosts implements PostsInterface {

	public function __construct(Posts $posts)
	{
		$this->posts 		= $posts;
		$this->post_type	= Config::get('constants.post_types.blog');
	}

	public function find($post_id)
	{
		return $this->posts->find($post_id);
	}

	public function updateOrCreate($post_data)
	{
		$post = $this->posts->firstOrNew(['id' => $post_data['id']]);
		$post->title 	= $post_data['title'];
		$post->content 	= $post_data['content'];
		$post->type 	= $post_data['type'];
		$post->save();
		return $post;
	}

	public function update($post_id, $post_data)
	{
		$post = $this->posts->find($post_id);

		foreach($post_data as $key => $value)
		{
			$post->$key = $value;
		}

		$post->save();
		return $post;
	}

	public function delete($post_id)
	{
		return $this->posts->find($post_id)->delete();
	}

}