<?php namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Playlists extends Model {

	protected $dates 	= ['deleted_at'];
	protected $table 	= 'playlists';
	protected $fillable = ['name'];
	protected $appends 	= [];
	protected $hidden 	= [];

	public function tracks()
	{
		return $this->belongsToMany('Blog\Tracks');
	}

}
