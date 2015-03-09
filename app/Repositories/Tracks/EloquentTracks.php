<?php namespace Blog\Repositories\Tracks;

//	Models
use Blog\Tracks;

//	Other
use Config;

class EloquentTracks implements TracksInterface {

	public function __construct(Tracks $tracks)
	{
		$this->tracks 		= $tracks;
	}

	public function all($skip = null)
	{
		return $this->tracks
			->orderBy('created_at', 'DESC')
			->skip($skip)
			->take(10)
			->get();
	}

	public function latest()
	{
		return $this->posts
			->orderBy('created_at', 'DESC')
			->take(10)
			->get();
	}

	public function find($track_id)
	{
		return $this->tracks->find($track_id);
	}

	public function store($track_data)
	{
		return $this->tracks->create([
				'name'		=> $track_data['name'],
				'artist'	=> $track_data['artist'],
				'link'		=> $track_data['link']
			]);
	}

	public function update($track_id, $track_data)
	{
		$track = $this->tracks->find($track_id);
		foreach ($track_data as $key => $value)
		{
			$track->$key 	= $value;
		}
		$track->save();
		return $track;
	}

	public function delete($track_id)
	{
		return $this->tracks->find($track_id)->delete();
	}

}