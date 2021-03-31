<?php

namespace App\Http\Controllers;

use App\Enums\Web;
use App\Facades\Spotify;
use App\Http\Requests\ResultRequest;
use App\Models\Genre;
use App\Services\SpotifyService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use SpotifyWebAPI\Request as SpotifyRequest;
use SpotifyWebAPI\Session as SpotifySession;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\SpotifyWebAPIAuthException;
use SpotifyWebAPI\SpotifyWebAPIException;

class RecomendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResultRequest $req)
    {
        $result = $req->validated()['result'];
        return view('recomendation', compact('result'));
    }
}
