<?php namespace Blog;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	protected $table = 'users';
	protected $fillable = ['firstname', 'lastname', 'email'];
	protected $hidden 	= ['remember_token'];

	public function posts()
	{
		return $this->hasMany('Blog\Posts', 'created_by');
	}

}
