<?php
require_once __DIR__ .'/../inc/bootstrap.php';

$bookId = request()->get('bookId');

try {
	$deleteBook = deleteBook($bookId);
	redirect('/Books_Library/books.php');
	exit;
}catch(Exception $e){
	redirect('/Books_Library/add.php');
}