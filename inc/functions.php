<?php

function request(){
	return \Symfony\Component\HttpFoundation\Request::createFromGlobals();
}

function redirect($path, $extra = []){
	$response = \Symfony\Component\HttpFoundation\Response::create(null, \Symfony\Component\HttpFoundation\Response::HTTP_FOUND, ['Location' => $path]);
	if (key_exists('cookies', $extra)){
		foreach ($extra['cookies'] as $cookie) {
			$response->headers->setCookie($cookie);
		}
	}
	$response->send();
	exit;
}

function addBook($title, $description){
	global $db;
	$ownerId = 0;
	try{
		$query = 'INSERT INTO books (title, description, owner_id) VALUES (:title, :description, :ownerId)';
		$stmt = $db->prepare($query);
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':description', $description);
		$stmt->bindParam(':ownerId', $ownerId);
		return $stmt->execute();
	}catch(Exception $e){
		throw $e;
	}
}

function getAllBooks(){
	global $db;
	try{
		$query = 'SELECT * FROM books';
		$stmt = $db->prepare($query);
		$stmt ->execute();
		return $stmt->fetchAll();
	}catch(Exception $e){
		throw $e;
	}
}

function getBook($book_id){
	global $db;
	try{
		$query = 'SELECT * FROM books WHERE book_id = ?';
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $book_id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}catch(Exception $e){
	throw $e;
	}
}

function editBook($book_id, $title, $description){
	global $db;
	try{
		$query = 'UPDATE books SET title = :title, description = :description WHERE book_id = :book_id';
		$stmt = $db->prepare($query);
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':description', $description);
		$stmt->bindParam(':book_id', $book_id);
		return $stmt->execute();

	}catch(Exception $e){
		throw $e;
	}
}

function deleteBook($book_id){
	global $db;
	try{
		$query = 'DELETE FROM books WHERE book_id = ?';
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $book_id);
		return $stmt->execute();
	}catch(Exception $e){
		throw $e;
	}
}

function findUserByEmail($email){
	global $db;
	try{
		$query = 'SELECT * FROM users WHERE email = :email';
		$stmt = $db->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}catch(Exception $e){
		throw $e;
	}
}

function createUser($email, $password){
	global $db;
	try{
		$query = 'INSERT INTO users (email, password, role_id) VALUES (:email, :password, 2)';
		$stmt = $db->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', $password);
		$stmt->execute();
		return $stmt->fetchAll();
	}catch(Exception $e){
		throw $e;
	}
}


function isAuthenticated(){
	if (!request()->cookies->has('access_token')){
		return false;
	}
	try{
		\Firebase\JWT\JWT::$leeway = 60;
		\Firebase\JWT\JWT::decode(request()->cookies->get('access_token'), getenv("SECRET_KEY"), ['HS256']);
		return true;
	}catch(Exception $e){
		return false;
	}
}

function requireAuth(){
	if(!isAuthenticated()){
		$accessToken = new \Symfony\Component\HttpFoundation\Cookie('access_token', 'Expired', time()-3600, '/Books_Library', getenv('COOKIE_DOMAIN'));
		redirect('/Books_Library/login.php', ['cookies' => [$accessToken]]);
	}
}