<?php
require_once __DIR__ .'/../inc/bootstrap.php';

$accessToken = new \Symfony\Component\HttpFoundation\Cookie('access_token', 'Expired', time()-3600, '/Books_Library', getenv('COOKIE_DOMAIN'));
redirect('/Books_Library', ['cookies' => [$accessToken]]);