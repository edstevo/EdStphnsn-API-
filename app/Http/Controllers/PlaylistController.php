<?php namespace Blog\Http\Controllers;

use Blog\Http\Requests;
use Blog\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Response;

use Blog\Repositories\Playlists\PlaylistsInterface;

class PlaylistController extends Controller {

	public function __construct(PlaylistsInterface $playlists)
	{
		$this->playlists = $playlists;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$playlists = $this->playlists->all();
		return Response::make(['data' => $playlists], 200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$playlist	= $this->playlists->store($request->only('name'));
		return $this->show($playlist->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $playlist_id
	 * @return Response
	 */
	public function show($playlist_id)
	{
		$playlist = $this->playlists->all($playlist_id);
		return Response::make(['data' => $playlist], 200);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $playlist_id
	 * @return Response
	 */
	public function update($playlist_id)
	{
		$playlist	= $this->playlists->update($playlist_id, $request->only('name'));
		return $this->show($playlist->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $playlist_id
	 * @return Response
	 */
	public function destroy($playlist_id)
	{
		$playlist = $this->playlists->delete($playlist_id);
		return Response::make(['result' => true], 200);
	}

}
