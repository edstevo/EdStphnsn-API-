<?php namespace Blog\Repositories\Posts;

interface PostsInterface {

	public function find($post_id);

	public function updateOrCreate($post_data);

	public function update($post_id, $post_data);

	public function delete($post_id);

}