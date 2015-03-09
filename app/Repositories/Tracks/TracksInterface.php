<?php namespace Blog\Repositories\Tracks;

interface TracksInterface {

	public function all($skip = null);
	public function latest();
	public function find($track_id);
	public function store($track_data);
	public function update($track_id, $track_data);
	public function delete($track_id);

}