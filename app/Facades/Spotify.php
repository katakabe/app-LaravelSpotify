<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\SpotifyService;

class Spotify extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SpotifyService::class;
    }
}
