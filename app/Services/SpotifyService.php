<?php

namespace App\Services;

use App\Enums\Web;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SpotifyWebAPI\Request as SpotifyRequest;
use SpotifyWebAPI\Session as SpotifySession;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\SpotifyWebAPIAuthException;
use SpotifyWebAPI\SpotifyWebAPIException;

class SpotifyService
{

    private $api;
    private $code;
    private $session;

    public function getSpotifyWebAPI(): SpotifyWebAPI
    {
        return $this->api;
    }

    public function getSpotifySession(): SpotifySession
    {
        return $this->session;
    }

    public function init(Request $req): SpotifyWebAPI
    {
        $this->auth($req->input('code'));
        return $this->getSpotifyWebAPI();
    }

    public function execute(SpotifyWebAPI $api, string $web, array $data = [])
    {
        $result = [];

        switch ($web) {
            case Web::RecommendationStore:
                $result = $this->getRecommendations($data, $api);
                break;
            case Web::PlaylistStore:
                $playlistId = $this->createPlaylist($data, $api);
                $result = $this->addPlaylistTracks($playlistId, $data, $api);
                break;
            case Web::PlaylistDestroy:
                $playlistId = $this->unfollowPlaylist($data, $api);
                break;
            case Web::GenreCreate:
                $genre = new Genre();
                $genre->createBySeeds($api);
                $result[] = true;
                break;
        }
        return $result;
    }

    private function auth(?string $code)
    {
        if (!isset($code)) {
            $location = $this->createSpotifySession()->getAuthorizeUrl([
                'scope' => [
                    'playlist-read-private',
                    'playlist-modify-private',
                    'user-read-private',
                    'playlist-modify',
                    'user-top-read'
                ]
            ]);
            return redirect()->to($location)->send();
        }
        $this->code = $code;
        $this->setSpotifySession();
        $this->setSpotifyWebAPI();
    }

    private function setSpotifyWebAPI(): void
    {
        $api = new SpotifyWebAPI();
        $session = $this->getSpotifySession();
        $api->setAccessToken($session->getAccessToken());
        $this->api = $api;
    }

    private function setSpotifySession(): void
    {
        $session = $this->createSpotifySession();
        $session->requestAccessToken($this->code);
        $this->session = $session;
    }

    private function createSpotifySession(): SpotifySession
    {
        return new SpotifySession(
            config('spotify.yourClientId'),
            config('spotify.yourClientSecret'),
            config('spotify.yourRedirectUri')
        );
    }

    private function getRecommendations(array $data, SpotifyWebAPI $api): array
    {
        $result = [];
        $seedArtists = $data['seed_artists'];
        $seedTracks = $data['seed_tracks'];

        $seedArtists = $this->parseSeeds($seedArtists, 'spotify:artist:');
        $seedTracks = $this->parseSeeds($seedTracks, 'spotify:track:');

        $recommendations = $api->getRecommendations([
            'limit'        => $data['limit'],
            'seed_artists' => $seedArtists,
            'seed_genres'  => $data['seed_genres'],
            'seed_tracks'  => $seedTracks,
            'min_tempo'    => $data['min_tempo'],
            'max_tempo'    => $data['max_tempo'],
            'mode'         => $data['mode'],
        ]);

        $tracks = $recommendations->tracks;
        foreach ($tracks as $t) {
            $result[] = [
                'song' => $t->name,
                'uri'  => $t->uri,
            ];
        }
        return $result;
    }


    private function createPlaylist(array $data, SpotifyWebAPI $api): string
    {
        $result = $api->createPlaylist([
            'name' => $data['playlist_name']
        ]);
        return $result->id;
    }

    private function addPlaylistTracks(string $playlistId, array $data, SpotifyWebAPI $api): array
    {
        $api->addPlaylistTracks(
            $playlistId,
            $data['uris'],
        );
        return ['playlist_uri' => $this->idToUri($playlistId, 'playlist')];
    }

    private function unfollowPlaylist(array $data, SpotifyWebAPI $api): bool
    {
        return $api->unfollowPlaylist($data['uri']);
    }

    private function parseSeeds(array $seeds, string $type): array
    {
        foreach ($seeds as $index => $seed) {
            if (strpos($seed, $type) !== false) {
                $seed = str_replace($type, '', $seed);
                $seeds[$index] = $seed;
            }
        }
        return $seeds;
    }

    private function idToUri($ids, $type)
    {
        $type = 'spotify:' . $type . ':';

        $ids = array_map(function ($id) use ($type) {
            if (substr($id, 0, strlen($type)) != $type && substr($id, 0, 7) != 'spotify') {
                $id = $type . $id;
            }

            return $id;
        }, (array) $ids);

        return count($ids) == 1 ? $ids[0] : $ids;
    }
}
