<?php namespace Blog\Observers;

use Illuminate\Contracts\Auth\Guard;

class PostsObserver {

	public function __construct(Guard $auth) {
		$this->auth 	= $auth;
	}

	public function creating($model) {
		$model->created_by = $this->auth->user()->id;
		$model->updated_by = $this->auth->user()->id;
	}

	public function created($model) {
	}

	public function updating($model) {
		$model->updated_by = $this->auth->user()->id;
	}

	public function updated($model) {
	}

	public function deleting($model) {
		$model->updated_by 	= $this->auth->user()->id;
		$model->deleted_by 	= $this->auth->user()->id;
	}

	public function deleted($model) {
	}

	public function restoring($model) {
		$model->deleted_by 	= null;
		$model->updated_by 	= $this->auth->user()->id;
	}

	public function restored($model) {
	}

}