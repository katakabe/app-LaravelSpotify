<?php
require_once('vendor/autoload.php');
    $session = new SpotifyWebAPI\Session(
        '6a126475b1264da99e676a2e7ed6f789',
        '95420b22c90d48129fdd539040aa9e0c'
    );
    $api = new SpotifyWebAPI\SpotifyWebAPI();
    $session->requestCredentialsToken();
    $accessToken = $session->getAccessToken();
    $api->setAccessToken($accessToken);
?>