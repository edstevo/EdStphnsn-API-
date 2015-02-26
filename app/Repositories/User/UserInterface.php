<?php namespace Blog\Repositories\User;

interface UserInterface {

	public function findByEmailOrCreate($user_email);

	public function getPosts($user);

	public function getDraftPosts($user);

}