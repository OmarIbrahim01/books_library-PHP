<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';

$book = getBook(request()->get('bookId'));

$bookTitle = $book['title'];
$bookDescription = $book['description'];
$buttonText = 'Update Book';
?>

<div class="container">
	<div class="well">
		<form class="form-horizontal" method="post" action="procedures/editBook.php">
			<input type="hidden" name="book_id" value="<?php echo $book['book_id']; ?>">
			<h2>Edit a book</h2>
			<?php include __DIR__ .'/inc/bookForm.php'; ?>
		</form>
	</div>
</div>
<?php
require_once __DIR__ . '/inc/footer.php';