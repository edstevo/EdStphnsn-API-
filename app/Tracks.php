<?php namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Tracks extends Model {

	protected $dates 	= ['deleted_at'];
	protected $table 	= 'tracks';
	protected $fillable = ['name', 'artist', 'link'];
	protected $appends 	= [];
	protected $hidden 	= [];

	public function playlists()
	{
		return $this->belongsToMany('Blog\Playlists');
	}

}
