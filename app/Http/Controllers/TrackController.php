<?php namespace Blog\Http\Controllers;

use Blog\Http\Requests;
use Blog\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Response;

use Blog\Repositories\Tracks\TracksInterface;

class TrackController extends Controller {

	public function __construct(TracksInterface $tracks)
	{
		$this->tracks = $tracks;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($skip = null)
	{
		$tracks = $this->tracks->all($skip);
		return Response::make(['data' => $tracks], 200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$track	= $this->tracks->store($request->only('name', 'artist', 'link'));
		$sync	= $this->tracks->syncPlaylists($track->id, [$request->get('playlist_id')]);
		return $this->show($track->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $track_id
	 * @return Response
	 */
	public function show($track_id)
	{
		$track = $this->tracks->find($track_id);
		return Response::make(['data' => $track], 200);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $track_id
	 * @return Response
	 */
	public function update(Request $request, $track_id)
	{
		$track	= $this->tracks->update($track_id, $request->only('name', 'artist', 'link'));
		return $this->show($track->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $track_id
	 * @return Response
	 */
	public function destroy($track_id)
	{
		$track = $this->tracks->delete($track_id);
		return Response::make(['result' => true], 200);
	}

}
