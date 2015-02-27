<?php namespace Blog\Repositories\Posts;

//	Functions
use Blog\Functions\Posts\PostsFunctions;

//	Models
use Blog\Posts;

//	Other
use Config;

class EloquentPosts implements PostsInterface {

	public function __construct(	Posts $posts,
									PostsFunctions $post_functions	)
	{
		$this->posts 			= $posts;
		$this->post_functions	= $post_functions;
		$this->post_type		= Config::get('constants.post_types.blog');
	}

	public function find($post_id)
	{
		return $this->posts
					->with(['creator', 'tags'])
					->find($post_id);
	}

	public function updateOrCreate($post_data)
	{
		$post_data['content']	= $this->post_functions->linkifyContent($post_data['content']);

		$post = $this->posts->firstOrNew(['id' => $post_data['id']]);
		$post->title 	= $post_data['title'];
		$post->content 	= $post_data['content'];
		$post->type 	= $post_data['type'];
		$post->save();
		return $post;
	}

	public function update($post_id, $post_data)
	{
		$post_data['content']	= $this->post_functions->linkifyContent($post_data['content']);

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

	public function syncTags($post_id, $tag_ids)
	{
		return $this->posts->find($post_id)
							->tags()
							->sync($tag_ids);
	}

}