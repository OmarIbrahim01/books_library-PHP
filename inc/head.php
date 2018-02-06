<?php require_once 'inc/bootstrap.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Book Library</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Book Voting</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="books.php">Book List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add.php">Add Book</a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php if(!isAuthenticated()): ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="procedures/doLogout.php">Logout</a>
        </li>
      <?php endif; ?>
    </ul>
 	</div>
	</nav>