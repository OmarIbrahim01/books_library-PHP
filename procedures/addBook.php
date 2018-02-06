<?php

require_once __DIR__ .'/../inc/bootstrap.php';

$bookTitle = request()->get('title');
$bookDescription = request()->get('description');
try {
	$newBook = addBook($bookTitle, $bookDescription);
	redirect('/Books_Library/books.php');
}catch(Exception $e){
	redirect('/Books_Library/add.php');
}