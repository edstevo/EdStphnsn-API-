<?php namespace Blog\Repositories\Playlists;

//	Models
use Blog\Playlists;

//	Other
use Config;

class EloquentPlaylists implements PlaylistsInterface {

	public function __construct(Playlists $playlists)
	{
		$this->playlists 		= $playlists;
	}

	public function all()
	{
		return $this->playlists
			->orderBy('created_at', 'DESC')
			->get();
	}

	public function find($playlist_id)
	{
		return $this->playlists->with('tracks')->find($playlist_id);
	}

	public function store($playlist_data)
	{
		return $this->playlists->create([
				'name'		=> $playlist_data['name']
			]);
	}

	public function update($playlist_id, $playlist_data)
	{
		$playlist = $this->playlists->find($playlist_id);
		foreach ($playlist_data as $key => $value)
		{
			$playlist->$key 	= $value;
		}
		$playlist->save();
		return $playlist;
	}

	public function delete($playlist_id)
	{
		return $this->playlists->find($playlist_id)->delete();
	}

}