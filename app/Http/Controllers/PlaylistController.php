<?php

namespace App\Http\Controllers;

use App\Enums\Web;
use App\Facades\Spotify;
use App\Http\Requests\ResultRequest;
use App\Models\Genre;
use App\Services\SpotifyService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use SpotifyWebAPI\Request as SpotifyRequest;
use SpotifyWebAPI\Session as SpotifySession;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\SpotifyWebAPIAuthException;
use SpotifyWebAPI\SpotifyWebAPIException;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResultRequest $req)
    {
        $result = $req->validated()['result'];
        $playlistUri = $result['playlist_uri'];
        return view('playlist', compact('playlistUri'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $uris = [];
        $playlistName = $req->input('playlist_name');

        foreach (range(1, $req->input('limit')) as $i) {
            $uris[] = $req->input('uri_' . $i);
        }

        if (empty($playlistName)) {
            $playlistName = '' . Carbon::now();
        }

        session([
            'web'  => Web::PlaylistStore,
            'data' => [
                'playlist_name' => $playlistName,
                'uris' => $uris,
            ],
        ]);
        Spotify::init($req);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req, string $uri)
    {
        session([
            'web'  => Web::PlaylistDestroy,
            'data' => [
                'uri' => $uri,
            ],
        ]);
        Spotify::init($req);
    }
}
