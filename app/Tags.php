<?php namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model {

	protected $table 		= 'tags';
	protected $fillable 	= ['name'];
	public $timestamps		= false;

	public function posts()
	{
		return $this->belongsToMany('Blog\Posts');
	}

}
