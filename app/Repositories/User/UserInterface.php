<?php namespace Blog\Repositories\User;

interface UserInterface {

	public function findByUsernameOrCreate($username);

	public function getPosts($user);

	public function getDraftPosts($user);

}