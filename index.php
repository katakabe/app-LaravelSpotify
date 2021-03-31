require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    '6a126475b1264da99e676a2e7ed6f789',
    '95420b22c90d48129fdd539040aa9e0cT',
    'http://localhost/finish'
);

$api = new SpotifyWebAPI\SpotifyWebAPI();

if (isset($_GET['code'])) {
    $session->requestAccessToken($_GET['code']);
    $api->setAccessToken($session->getAccessToken());

    print_r($api->me());
} else {
    $options = [
        'scope' => [
            'user-read-email',
        ],
    ];

    header('Location: ' . $session->getAuthorizeUrl($options));
    die();
}