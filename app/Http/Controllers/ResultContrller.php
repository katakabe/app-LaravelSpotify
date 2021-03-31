<?php

namespace App\Http\Controllers;

use App\Enums\Web;
use App\Facades\Spotify;
use App\Services\SpotifyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use SpotifyWebAPI\Request as SpotifyRequest;
use SpotifyWebAPI\Session as SpotifySession;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\SpotifyWebAPIAuthException;
use SpotifyWebAPI\SpotifyWebAPIException;

class ResultContrller extends Controller
{

    private $service;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $api = Spotify::init($req);
        $web = session('web');
        $data = session('data');

        if ($web && $data) {
            $result = Spotify::execute($api, $web, $data);
            switch ($web) {
                case Web::RecommendationStore:
                    return redirect()->route('recomendation.index', ['result' => $result]);
                    break;
                case Web::PlaylistStore:
                    return redirect()->route('playlist.index', ['result' => $result]);
                    break;
                case Web::PlaylistDestroy:
                    return redirect()->route('condition.index');
                    break;
                case Web::GenreCreate:
                    break;
            }
        }
    }
}
