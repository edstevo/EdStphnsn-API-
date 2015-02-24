<?php namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model {

	protected $table 	= 'posts';
	protected $fillable = ['title', 'content'];
	protected $hidden 	= [];

	public function creator()
	{
		return $this->belongsTo('Blog\User');
	}

	public function created_data()
	{
		$return 		= (object)[];
		$return->user 	= $this->creator();
		$return->time 	= $this->created_at();

		return $return;
	}

	public function post()
	{
		return $this->hasMany('Blog\Posts');
	}

}
