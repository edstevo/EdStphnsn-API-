<?php namespace Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model {

    use SoftDeletes;

	protected $dates 	= ['deleted_at'];
	protected $table 	= 'posts';
	protected $fillable = ['title', 'content', 'lat', 'lng'];
	protected $hidden 	= [];

	public function creator()
	{
		return $this->belongsTo('Blog\User', 'created_by');
	}

	public function created_data()
	{
		$return 		= (object)[];
		$return->user 	= $this->creator();
		$return->time 	= $this->created_at();

		return $return;
	}

	public function comments()
	{
		return $this->hasMany('Blog\Comments');
	}

	public function tags()
	{
		return $this->belongsToMany('Blog\Tags');
	}

}
