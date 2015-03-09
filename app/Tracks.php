<?php namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Tracks extends Model {

	protected $dates 	= ['deleted_at'];
	protected $table 	= 'tracks';
	protected $fillable = ['name', 'artist', 'link'];
	protected $appends 	= [];
	protected $hidden 	= [];

	public function playlist()
	{
		return $this->belongsToMany('Blog\Playlists');
	}

}
