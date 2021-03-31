<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class Web extends Enum implements LocalizedEnum
{
    const GenreCreate         = 'genre/create';
    const PlaylistStore       = 'playlist/store';
    const PlaylistDestroy     = 'playlist/destroy';
    const RecommendationStore = 'recommendation/store';
}
