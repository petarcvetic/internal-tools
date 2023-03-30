<?php
// probni komentar
	//SEO
	$page_title = "Kartica Firme";
	$keywords = "mont,kartica,firme,dobavljac,faktura";
	$description = "Knjigovodstvena aplikacija za izlistavanje kartice firme i unos faktura";

	$today = date("Y-m-d");

	$msg = $path = "";

	include "dbconfig.php";


	/*KLIKNUTO JE DUGME LOGIN NA LOGIN FORMI*/
	if (isset($_POST['submitBtnLogin'])) {

		$username = strip_tags($_POST['username']);
		$password = sha1(strip_tags($_POST['password']));

		if ($username != "" && $password != "") {
			$password = sha1(strip_tags($_POST['password']));
			echo "<script>alert('".$username ." / ". $password."');</script>";
			$user->login($username, $password);
		} else {
			$msg = "Oba polja moraju biti popunjena!";
			echo "<script>alert('".$msg."');</script>";
		}
	}

	include $path."assets/header.php";
?>

	<div class="container">
<style>
body {
  background-image: ('');
}
</style>
<?php
	/*AKO JE USER ULOGOVAN (ako postoji sesija sess_user_id*/
	if ($user->is_loggedin() != "") {
?>

	<h1> EXECUTIVE DIGITAL - INTERNAL TOOLS </h1>
		<div class="toolbox">Tools
			<ul>
				<li>NAS</li>
				<li>DizNAS</li>
				<li>tul1</li>
				<li>tul2</li>
				<li>tul3</li>
				<li>tul4</li>
			</ul>
		</div>

<?php 
	}else{
		include $path."assets/login_form.php";
	}
?>

</div><!--end .container -->



<?php

	require_once $path."assets/footer.php";
?>
