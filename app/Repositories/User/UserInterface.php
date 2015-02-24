<?php namespace Blog\Repositories\User;

interface UserInterface {

	public function findByEmailOrCreate($user_email);

}