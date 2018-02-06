<?php
require_once __DIR__ .'/../inc/bootstrap.php';
$email = request()->get('email');
$password = request()->get('password');
$passwordConfirm = request()->get('password_confirmation');
if ($password != $passwordConfirm){
	redirect('/Books_Library/register.php');
}

$user = findUserByEmail($email);

if (!empty($user)){
	redirect('/Books_Library/register.php');
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

try {
	$createUser = createUser($email, $hashed);

	$user = findUserByEmail($email);
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

}catch(Exception $e){
	redirect('/Books_Library/register.php');
}