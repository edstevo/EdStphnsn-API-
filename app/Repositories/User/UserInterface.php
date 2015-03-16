<?php namespace Blog\Repositories\User;

interface UserInterface {

	public function findByUsernameOrCreate($user_email);

	public function getPosts($user);

	public function getDraftPosts($user);

}