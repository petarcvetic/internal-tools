<?php
	$path = "../";
	include $path."dbconfig.php";

	/*AKO JE USER ULOGOVAN (ako postoji sesija sess_user_id*/
	if ($user->is_loggedin() == "") {
		header('Location: '.$path);
	}

	include $path."assets/header.php";
?>

	<div class="container">


	</div><!--end .container -->

<?php

	require_once $path."assets/footer.php";
?>
