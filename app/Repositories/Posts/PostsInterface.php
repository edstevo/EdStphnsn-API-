<?php namespace Blog\Repositories\Posts;

interface PostsInterface {

	public function all();

	public function find($post_id);

	public function findByUser($user_id);

	public function store($post_data);

	public function update($post_id, $post_data);

	public function delete($post_id);

}