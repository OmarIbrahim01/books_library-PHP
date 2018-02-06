<?php
require_once __DIR__ .'/../inc/bootstrap.php';

$user = findUserByEmail(request()->get('email'));

if (empty($user)){
	redirect('/Books_Library/login.php');
}

if (!password_verify(request()->get('password'), $user['password'])){
	redirect('/Books_Library/login.php');
}

$expTime = time()+3600;

$token = [
	'iss' => request()->getBaseUrl(),		#Issuer 	Who issues this claim?
	'sub' => "{$user['user_id']}",			#Subject	Who is the subject?
	'exp' => $expTime,									#Expiration Time	When this JWT expires
	'iat' => time(),										#Issued At	Seconds since epoch
	'nbf' => time(),										#Not Before	Seconds since epoch
	'is_admin' => $user['role_id'] == 1
];

$jwt = \Firebase\JWT\JWT::encode($token, getenv("SECRET_KEY"), 'HS256');


$accessToken = new \Symfony\Component\HttpFoundation\Cookie('access_token', $jwt, $expTime, '/Books_Library', getenv('COOKIE_DOMAIN'));

redirect('../index.php', ['cookies'=>[$accessToken]]);



















// var_dump($jwt);

// $decoded = \Firebase\JWT\JWT::decode($jwt, getenv("SECRET_KEY"), array('HS256'));

// var_dump($decoded);

// var_dump($accessToken);