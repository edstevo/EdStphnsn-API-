<?php namespace Blog\Repositories\Playlists;

interface PlaylistsInterface {

	public function all();
	public function find($playlist_id);
	public function store($playlist_data);
	public function update($playlist_id, $playlist_data);
	public function delete($playlist_id);

}