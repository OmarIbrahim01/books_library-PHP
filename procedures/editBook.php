<?php

require_once __DIR__ .'/../inc/bootstrap.php';

$bookTitle = request()->get('title');
$bookDescription = request()->get('description');
$bookId = request()->get('book_id');
var_dump($bookTitle);var_dump($bookDescription);var_dump($bookId);
try {
	editBook($bookId, $bookTitle, $bookDescription);
	redirect('/Books_Library/books.php');
}catch(Exception $e){
	redirect('/Books_Library/edit.php?bookId='.$bookId);
}