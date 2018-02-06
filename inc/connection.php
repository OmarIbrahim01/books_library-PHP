<?php

try{
	$db = new PDO('mysql:dbname=books_library;host=localhost', 'root','');
}catch(Exception $e){
	throw $e;	
}

?>
