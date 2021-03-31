<?php

namespace App\Models;

use SpotifyWebAPI\SpotifyWebAPI;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
    ];

    protected $casts = [
        'id'   => 'integer',
        'name' => 'string',
    ];

    public function createBySeeds(SpotifyWebAPI $api): void
    {
        $genres = $api->getGenreSeeds()->genres;
        foreach ($genres as $seed) {
            self::create([
                'name' => $seed
            ]);
        }
    }
}
