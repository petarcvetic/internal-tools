<?php
$ukupno = 0;
$message = $artikliKomadi =  $selected1 =  $selected2 =  $selected3 = $selected4 = "";
$today = date("Y-m-d");

include "dbconfig.php";
include "assets/header.php";

if ($user->is_loggedin() != "" && $_SESSION['sess_korisnik_status'] != "0" && $_SESSION['sess_user_status'] > 2) {

/*Podaci USER-a*/
	$useID = $_SESSION['sess_user_id'];
	$username = $_SESSION['sess_user_name'];
	$id_korisnika = $_SESSION['sess_id_korisnika'];
	$statusUser = $_SESSION['sess_user_status'];

	if ($statusUser < "2") { /*Ako je user saradnik*/
		header("Location: magacin.php");
	}

/*Podaci KORISNIKA*/
	$korisnik = $_SESSION['sess_korisnik_name'];

	if ($korisnik != "") {
		$korisnikRow = $getData->get_korisnik($id_korisnika);

		$adresaKorisnika = $korisnikRow["adresa"];
		$mestoKorisnika = $korisnikRow["mesto"];
		$maticniBrojKorisnika = $korisnikRow["maticni_broj"];
		$pibKorisnika = $korisnikRow["pib"];
		$sifraDelatnostiKorisnika = $korisnikRow["sifra_delatnosti"];
		$telefon = $korisnikRow["telefon"];
		$fax = $korisnikRow["fax"];
		$tekuciRacun = $korisnikRow["tekuci_racun"];
		$banka = $korisnikRow["banka"];
		$logoKorisnika = $korisnikRow["logo"];
		$dodatakBroju = $korisnikRow["dodatak_broju"];
		$statusKorisnika = $korisnikRow['status'];
	} else {
		$statusKorisnika = 0;
	}

	if ($statusUser !== "0") {

	//Ako je kliknuto submit-user
	if (isset($_POST['submit-user'])) {
		$id_admin = strip_tags($_POST["user-id"]);
		$user_ime = strip_tags($_POST['user-ime']);
		$user_prezime = strip_tags($_POST['user-prezime']);
		$user_username = strip_tags($_POST['user-username']);
		$password = sha1(strip_tags($_POST['user-password']));
		$email = strip_tags($_POST['user-email']);
		$status = strip_tags($_POST['user-rola']);

		if ($user_ime != "" && $user_prezime != "" && $user_username != "" && $email != "" && $status != "") {
			$existingUsername = $getData->if_username_exists_in_other_users($user_username, $id_korisnika, $id_admin);
			$existingEmail = $getData->if_user_mail_exists_in_other_users($email, $id_korisnika, $id_admin);

			if($password != ""){
				$new_password = "password='".$password."', ";
			}

			if($existingUsername > 0){
				$message = "Usename \"".$user_username."\" već postoji u bazi";
			}

			if ($existingEmail > 0) {
				$message = "Ovaj email je zauzet";
			}

			if ($message == "") {
				$insertData->update_usera($user_ime, $user_prezime, $user_username, $new_password, $email, $status, $id_korisnika, $id_admin);
			} else {
				echo "<script> alert('" . $message . "'); </script>";
			}
		}
	}

		if ($statusKorisnika == '1') {
			if (isset($_GET['id-usera'])) {
				$id_usera = strip_tags($_GET['id-usera']);
			} else {
				$id_usera = -1;
			}?>


				<div class="unos">
					<div class="unos-form-container">

					<?php
					if ($id_usera <= 0) {
						$useri = $getData->get_all_users($id_korisnika);
					?>
						<input type="text" class="center-text input-small proizvod-input" list="datalist_edit" size="34" onChange="redirect_to(this,'edit-usera')" placeholder="Odaberi user-a">

						<datalist id="datalist_edit">

						<?php
						foreach ($useri as $user) {
							if($user["status"]<5){
								echo "<option id='" . $user['id_admin'] . "' value='" . $user['user_ime'] . " " . $user['user_prezime'] . "'>";
							}
						}
						echo "</datalist>";
					} elseif ($getData->if_user_id_exists_for_korisnik($id_korisnika, $id_usera) > 0) {
						$user_data = $getData->get_user_by_id_and_korisnik($id_korisnika, $id_usera);

						if($user_data['status'] == 0){
							$selected1 = "selected";
						}elseif($user_data['status'] == 1){
							$selected2 = "selected";
						}elseif ($user_data['status'] == 2) {
							$selected3 = "selected";
						}elseif ($user_data['status'] == 3) {
							$selected4 = "selected";
						}
					?>
						<!--Forma PROIZVODI-->
						<div id="form1" class="show">

							<h1 class="center-text white-text">EDIT User-a</h1>

							<form action="" method="post" class="forme-unosa">

								<div class="form-inputs">
									<div class="left-row">
										<input type="hidden" name="user-id" value="<?php echo $user_data['id_admin']; ?>">
										Ime: <input type="text" class="center-text input-field" name="user-ime" placeholder="Ime" value="<?php echo $user_data['user_ime']; ?>" required>
										Prezime: <input type="text" class="center-text input-field" name="user-prezime" placeholder="Prezime" value="<?php echo $user_data['user_prezime']; ?>" required>
										Usernamer: <input type="text" class="center-text input-field" name="user-username" placeholder="Username" value="<?php echo $user_data['username']; ?>" required>
										New password:<input type="password" class="center-text input-field" name="user-password" id="user-password" placeholder="Password" value="" autocomplete="new-password">
										<label><input type="checkbox" onclick="showPassword()">Show Password</label>
									</div>

									<div class="right-row">
										Email: <input type="email" class="center-text input-field" name="user-email" placeholder="email" value="<?php echo $user_data['email']; ?>" required>
										<select class="center-text input-field" name="user-rola" placeholder="Privilegija" required>
											<option value="" disabled selected>Privilegija</option>
											<option value="0" <?php echo $selected1; ?> >Blokiran</option>
											<option value="1" <?php echo $selected2; ?> >Saradnik</option>
											<option value="2" <?php echo $selected3; ?> >Zaposleni</option>
											<option value="3" <?php echo $selected4; ?> >Admin</option>
										</select>
									</div>
								</div>

								<div class="unos-button">
					        <input type="submit" class="submit button-full" name="submit-user" value="Submit"><br><br>
					      </div>

							</form>

						</div>
					<?php } else {
						echo "<script>alert('User sa zadatim ID-jem ne postoji u bazi')</script>";
					}?>
					</div><!--END unos-form-container-->
				</div><!--END unos -->


			<?php	} elseif ($statusKorisnika == '0') {
				echo "<h1 class='centerText'>ZBOG NEIZMIRENIH OBAVEZA STE PRIVREMENO ISKLJUCENI!</h1><br><br><br><br><br><br><br><br>";
			} else {
			// ako status korisnika nije '1' ili '2' vec je '0'
				echo "<h1 class='centerText'>TRENOTNO SE RADI NA POBOLJSANJU APLIKACIJE!</h1><br><br><br><br><br><br><br><br>";
			}

		} else {
		// ako je status usera "0" (blokirani user)
		echo "<div class='centerText'>
            <h1>IZ NEKOG RAZLOGA STE BLOKIRANI!</h1>
            <h2>Proverite svoju email poštu</h2>
          </div>";
	}
} else {
	header("Location: index.php");
}

include "assets/footer.php";
?>

<script type="text/javascript">
 function mediaSize(){
    if (window.matchMedia('(max-device-width: 768px)').matches){
      $("body").css("background-image", "url('images/background_mobile.webp')");
      $(".header").css("border-bottom", "none");
    }
    else{
      $("body").css("background-image", "url('images/background.webp')");
    }
  }

  mediaSize();
</script>