<?php

namespace App\Http\Controllers;

use App\Enums\Web;
use App\Facades\Spotify;
use App\Http\Requests\ConditionRequest;
use App\Models\Genre;
use App\Services\SpotifyService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use SpotifyWebAPI\Request as SpotifyRequest;
use SpotifyWebAPI\Session as SpotifySession;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\SpotifyWebAPIAuthException;
use SpotifyWebAPI\SpotifyWebAPIException;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = [];
        foreach (Genre::all() as $genre) {
            $genres[] = $genre->name;
        }
        return view('condition', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConditionRequest $req)
    {
        $seedArtists = [];
        $seedTracks = [];

        foreach (range(1, 2) as $i) {
            $seedArtists[] = $req->validated()['seed_artists_' . $i];
            $seedTracks[] = $req->validated()['seed_tracks_' . $i];
        }

        // 配列の index を詰めておく
        $seedArtists = (array_filter($seedArtists));
        $seedTracks = (array_filter($seedTracks));

        session([
            'web'  => Web::RecommendationStore,
            'data' => [
                'seed_genres'  => $req->validated()['seed_genres'],
                'seed_artists' => $seedArtists,
                'seed_tracks'  => $seedTracks,
                'min_tempo'    => $req->validated()['min_tempo'],
                'max_tempo'    => $req->validated()['max_tempo'],
                'mode'         => $req->validated()['modes'],
            ],
        ]);
        Spotify::init($req);
    }
}
