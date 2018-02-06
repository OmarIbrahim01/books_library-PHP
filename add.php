<?php
require_once __DIR__ . '/inc/bootstrap.php';
requireAuth();
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

<div class="container">
	<div class="well">
		<form class="form-horizontal" method="post" action="procedures/addBook.php">
			<h2>Add a book</h2>
			<?php include __DIR__ .'/inc/bookForm.php'; ?>
		</form>
	</div>
</div>
<?php
require_once __DIR__ . '/inc/footer.php';