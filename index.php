<?php
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
.container {

   background: url(img/exe-digi.webp) no-repeat center center fixed; 
  background-size: 30%;

}
</style>
<?php
	/*AKO JE USER ULOGOVAN (ako postoji sesija sess_user_id*/
	if ($user->is_loggedin() != "") {
		$user_data = $getData->get_user_by_id($_SESSION['sess_user_id']);

		if($user_data["activated"] == "0"){
			echo "<script>
							if (confirm('Please check your email and activate your account!') == true) {
							  window.location.href = 'logout.php';
							} else {
							  window.location.href = 'logout.php';
							}
			</script>";
		}

		
?>

		<h1> EXECUTIVE DIGITAL - INTERNAL TOOLS </h1>

		<div class="toolbox">
			<p>Tools</p>


			<?php
				$tools = $getData->get_tools_by_team($_SESSION['sess_team'], $_SESSION['sess_user_status']);

				foreach ($tools as $tool) {
					echo "
					<form action='".$tool['tool_url']."' method='post' target='_blank'>
					    <input type='hidden' name='".$tool['tool_username_key']."' value='".$tool['tool_username']."'>
					    <input type='hidden' name='".$tool['tool_password_key']."' value='".$tool['tool_password']."'>
					    <input type='submit' name='submit' value='".$tool['tool_name']."'>
					</form>
					";
				}
			?>

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
