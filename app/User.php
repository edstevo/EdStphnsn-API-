<?php namespace Blog;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	protected $table 	= 'users';
	protected $fillable = ['firstname', 'lastname', 'username', 'admin'];
	protected $appends 	= ['name'];
	protected $hidden 	= ['firstname', 'lastname', 'username', 'remember_token'];

	public function posts()
	{
		return $this->hasMany('Blog\Posts', 'created_by');
	}

	public function getNameAttribute()
	{
		if (is_null($this->firstname))
		{
			return $this->username;
		}

		return $this->firstname." ".$this->lastname;
	}

	public function getAdminAttribute($value) {
		return ($value) ? true : false;
	}

}
