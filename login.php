<?php
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

<div class="container">
	<div class="well">
		<form class="form-horizontal" method="post" action="procedures/doLogin.php">
			<h2>Login</h2>
			<?php include __DIR__ .'/inc/loginForm.php'; ?>
		</form>
	</div>
</div>
<?php
require_once __DIR__ . '/inc/footer.php';