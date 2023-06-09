<?php

class InsertData {

	private $db;
	private $status = '1';
	private $ststus_blokiran = '0';

	function __construct($DB_con) {
		$this->db = $DB_con;
	}

	private function insert_data($query, $stmtArray, $bind) {
		try {
			$stmt = $this->db->prepare($query);

			foreach ($stmtArray as $key => $val) {
				$stmt->$bind($key, $val, PDO::PARAM_STR);
			}

			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (DOException $e) {
			echo $e->getMessage();
		}
	}


	public function insert_project($project_name, $teamwork_link, $client_email) {
		$query = "INSERT INTO projects (project_name, teamwork_link, contact, status) VALUES (:project_name, :teamwork_link, :contact, '1')";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"project_name" => $project_name,
			"teamwork_link" => $teamwork_link,
			"contact" => $client_email,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function insert_webslite_live($project_id, $live_url, $live_username, $live_password ) {
		$query = "INSERT INTO live_sites (project_id, live_url, live_username, live_password) VALUES (:project_id, :live_url, :live_username, :live_password)";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"project_id" => $project_id,
			"live_url" => $live_url,
			"live_username" => $live_username,
			"live_password"=>$live_password,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function insert_webslite_stage($project_id, $stage_url, $stage_username, $stage_password ) {
		$query = "INSERT INTO stage_sites (project_id, stage_url, stage_username, stage_password) VALUES (:project_id, :stage_url, :stage_username, :stage_password)";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"project_id" => $project_id,
			"stage_url" => $stage_url,
			"stage_username" => $stage_username,
			"stage_password"=>$stage_password,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}


	public function insert_tool($tool_name, $tool_url, $tool_username_key, $tool_username, $tool_password_key, $tool_password, $teams) {
		$query = "INSERT INTO tools (tool_name, tool_url, tool_username_key, tool_username, tool_password_key, tool_password, teams) VALUES (:tool_name, :tool_url, :tool_username_key, :tool_username, :tool_password_key, :tool_password, :teams)";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"tool_name" => $tool_name,
			"tool_url" => $tool_url,
			"tool_username_key" => $tool_username_key,
			"tool_username" => $tool_username,
			"tool_password_key"=>$tool_password_key,
			"tool_password"=>$tool_password,
			"teams" => $teams,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}


	public function edit_tool($tool_id, $tool_name, $tool_url, $tool_username_key, $tool_username, $tool_password_key, $tool_password, $teams) {
		$query = "UPDATE tools SET tool_name=:tool_name, tool_url=:tool_url, tool_username_key=:tool_username_key, tool_username=:tool_username, tool_password_key=:tool_password_key, tool_password=:tool_password, teams=:teams WHERE tool_id=:tool_id";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"tool_name" => $tool_name,
			"tool_url" => $tool_url,
			"tool_username_key" => $tool_username_key,
			"tool_username" => $tool_username,
			"tool_password_key" => $tool_password_key,
			"tool_password" => $tool_password,
			"teams" => $teams,
			"tool_id" => $tool_id,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}



	/**/

	public function unos_proizvoda($id_korisnika, $naziv_proizvoda, $cena_proizvoda, $tezina_proizvoda, $cena_saradnika, $id_magacina, $kolicina_u_magacinu, $sifra_proizvoda, $broj_paketa) {
		$query = "INSERT INTO proizvodi (id_korisnika, naziv_proizvoda, cena_proizvoda, tezina_proizvoda, cena_saradnika, id_magacina, kolicina_u_magacinu, sifra_proizvoda, broj_paketa) VALUES (:id_korisnika, :naziv_proizvoda, :cena_proizvoda, :tezina_proizvoda, :cena_saradnika, :id_magacina, :kolicina_u_magacinu, :sifra_proizvoda, :broj_paketa)";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"id_korisnika" => $id_korisnika,
			"naziv_proizvoda" => $naziv_proizvoda,
			"cena_proizvoda" => $cena_proizvoda,
			"tezina_proizvoda" => $tezina_proizvoda,
			"cena_saradnika" => $cena_saradnika,
			"id_magacina" => $id_magacina,
			"kolicina_u_magacinu" => $kolicina_u_magacinu,
			"sifra_proizvoda" => $sifra_proizvoda,
			"broj_paketa" => $broj_paketa,
		);
		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function unos_saradnika($id_korisnika, $ime_saradnika, $prezime_saradnika) {
		$query = "INSERT INTO saradnici (id_korisnika, ime_saradnika, prezime_saradnika) VALUES (:id_korisnika, :ime_saradnika, :prezime_saradnika)";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"id_korisnika" => $id_korisnika,
			"ime_saradnika" => $ime_saradnika,
			"prezime_saradnika" => $prezime_saradnika,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function unos_grada($ime_grada, $postanski_broj) {
		$query = "INSERT INTO gradovi (ime_grada, postanski_broj) VALUES (:ime_grada, :postanski_broj)";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"ime_grada" => $ime_grada,
			"postanski_broj" => $postanski_broj,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function unos_usera($user_ime, $user_prezime, $username, $password, $email, $id_korisnika, $status) {
		$query = "INSERT INTO admin (user_ime, user_prezime, username, password, email, id_korisnika, status) VALUES (:user_ime, :user_prezime, :username, :password, :email, :id_korisnika, :status)";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"user_ime" => $user_ime,
			"user_prezime" => $user_prezime,
			"username" => $username,
			"password" => $password,
			"email" => $email,
			"id_korisnika" => $id_korisnika,
			"status" => $status,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function unos_troska($id_korisnika, $datum_troska, $namena_troska, $iznos_troska, $user) {
		$query = "INSERT INTO troskovi (id_korisnika, datum_troska, namena_troska, iznos_troska, user, status) VALUES (:id_korisnika, :datum_troska, :namena_troska, :iznos_troska, :user, :status)";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"id_korisnika" => $id_korisnika,
			"datum_troska" => $datum_troska,
			"namena_troska" => $namena_troska,
			"iznos_troska" => $iznos_troska,
			"user" => $user,
			"status" => $this->status,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function update_troska($datum_troska, $namena_troska, $iznos_troska, $id_troska, $id_korisnika) {
		$query = "UPDATE troskovi SET datum_troska=:datum_troska, namena_troska=:namena_troska, iznos_troska=:iznos_troska  WHERE id_troska=:id_troska AND id_korisnika=:id_korisnika";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"datum_troska" => $datum_troska,
			"namena_troska" => $namena_troska,
			"iznos_troska" => $iznos_troska,
			"id_troska" => $id_troska,
			"id_korisnika" => $id_korisnika,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}
	

	public function update_usera($user_ime, $user_prezime, $username, $password, $email, $status, $id_korisnika, $id_admin) {
		$query = "UPDATE admin SET user_ime=:user_ime, user_prezime=:user_prezime, username=:username, $password email=:email, status=:status WHERE id_admin=:id_admin AND id_korisnika=:id_korisnika";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"user_ime" => $user_ime,
			"user_prezime" => $user_prezime,
			"username" => $username,
			"email" => $email,
			"status" => $status,
			"id_admin" => $id_admin,
			"id_korisnika" => $id_korisnika,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function insert_new_porudzbina($id_korisnika, $datum, $id_magacina, $ime_i_prezime, $mesto, $adresa, $telefon, $id_saradnika, $prevoznik, $artikliKomadi, $ukupno, $ukupna_tezina, $ukupan_broj_paketa, $user, $napomena, $postarina) {
		$query = "INSERT INTO porudzbine (id_korisnika, datum, id_magacina, ime_i_prezime, mesto, adresa, telefon, id_saradnika, prevoznik, artikliKomadi, ukupno, ukupna_tezina, ukupan_broj_paketa, user, napomena, postarina, status) VALUES (:id_korisnika, :datum, :id_magacina, :ime_i_prezime, :mesto, :adresa, :telefon, :id_saradnika, :prevoznik, :artikliKomadi, :ukupno, :ukupna_tezina, :ukupan_broj_paketa, :user, :napomena, :postarina, :status)";
		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"id_korisnika" => $id_korisnika,
			"datum" => $datum,
			"id_magacina" => $id_magacina,
			"ime_i_prezime" => $ime_i_prezime,
			"mesto" => $mesto,
			"adresa" => $adresa,
			"telefon" => $telefon,
			"id_saradnika" => $id_saradnika,
			"prevoznik" => $prevoznik,
			"artikliKomadi" => $artikliKomadi,
			"ukupno" => $ukupno,
			"ukupna_tezina" => $ukupna_tezina,
			"ukupan_broj_paketa" => $ukupan_broj_paketa,
			"user" => $user,
			"napomena" => $napomena,
			"postarina" => $postarina,
			"status" => $this->status,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function update_porudzbina_by_id($datum, $id_magacina, $ime_i_prezime, $mesto, $adresa, $telefon, $id_saradnika, $prevoznik, $broj_posiljke, $artikliKomadi, $ukupno, $ukupna_tezina, $ukupan_broj_paketa, $user, $napomena, $postarina, $status, $id_korisnika, $id_narudzbine) {
		$query = "UPDATE porudzbine SET datum=:datum, id_magacina=:id_magacina, ime_i_prezime=:ime_i_prezime, mesto=:mesto, adresa=:adresa, telefon=:telefon, id_saradnika=:id_saradnika, prevoznik=:prevoznik, broj_posiljke=:broj_posiljke, artikliKomadi=:artikliKomadi, ukupno=:ukupno, ukupna_tezina=:ukupna_tezina, ukupan_broj_paketa=:ukupan_broj_paketa, user=:user, napomena=:napomena, postarina=:postarina, status=:status WHERE id_korisnika=:id_korisnika AND id_narudzbine=:id_narudzbine";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"datum" => $datum,
			"id_magacina" => $id_magacina,
			"ime_i_prezime" => $ime_i_prezime,
			"mesto" => $mesto,
			"adresa" => $adresa,
			"telefon" => $telefon,
			"id_saradnika" => $id_saradnika,
			"prevoznik" => $prevoznik,
			"broj_posiljke" => $broj_posiljke,
			"artikliKomadi" => $artikliKomadi,
			"ukupno" => $ukupno,
			"ukupna_tezina" => $ukupna_tezina,
			"ukupan_broj_paketa" => $ukupan_broj_paketa,
			"user" => $user,
			"napomena" => $napomena,
			"postarina" => $postarina,
			"status" => $status,
			"id_korisnika" => $id_korisnika,
			"id_narudzbine" => $id_narudzbine,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function update_stanje_proizvoda($kolicina_u_magacinu, $id_proizvoda, $id_korisnika) {
		$query = "UPDATE proizvodi SET kolicina_u_magacinu=:kolicina_u_magacinu WHERE id_proizvoda=:id_proizvoda AND id_korisnika=:id_korisnika";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"kolicina_u_magacinu" => $kolicina_u_magacinu,
			"id_proizvoda" => $id_proizvoda,
			"id_korisnika" => $id_korisnika,
		);
//		return $this->insert_data($query, $stmtArray, "bindParam");
		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function update_status_porudzbine($id_korisnika, $id_narudzbine, $status) {
		$query = "UPDATE porudzbine SET status=:status WHERE id_narudzbine=:id_narudzbine AND id_korisnika=:id_korisnika";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"status" => $status,
			"id_korisnika" => $id_korisnika,
			"id_narudzbine" => $id_narudzbine,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function update_broja_posiljke($broj_posiljke, $id_narudzbine, $id_korisnika) {
		$query = "UPDATE porudzbine SET broj_posiljke=:broj_posiljke WHERE id_narudzbine=:id_narudzbine AND id_korisnika=:id_korisnika";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"broj_posiljke" => $broj_posiljke,
			"id_korisnika" => $id_korisnika,
			"id_narudzbine" => $id_narudzbine,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function update_proizvoda($naziv_proizvoda, $cena_proizvoda, $tezina_proizvoda, $cena_saradnika, $id_magacina, $kolicina_u_magacinu, $sifra_proizvoda, $broj_paketa, $id_proizvoda, $id_korisnika) {
		$query = "UPDATE proizvodi SET naziv_proizvoda=:naziv_proizvoda, cena_proizvoda=:cena_proizvoda, tezina_proizvoda=:tezina_proizvoda, cena_saradnika=:cena_saradnika, id_magacina=:id_magacina, kolicina_u_magacinu=:kolicina_u_magacinu, sifra_proizvoda=:sifra_proizvoda, broj_paketa=:broj_paketa WHERE id_proizvoda=:id_proizvoda AND id_korisnika=:id_korisnika";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"naziv_proizvoda" => $naziv_proizvoda,
			"cena_proizvoda" => $cena_proizvoda,
			"tezina_proizvoda" => $tezina_proizvoda,
			"cena_saradnika" => $cena_saradnika,
			"id_magacina" => $id_magacina,
			"kolicina_u_magacinu" => $kolicina_u_magacinu,
			"sifra_proizvoda" => $sifra_proizvoda,
			"broj_paketa" => $broj_paketa,
			"id_proizvoda" => $id_proizvoda,
			"id_korisnika" => $id_korisnika,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function delete_row($tabela, $id, $id_korisnika) {
		if ($tabela == "troskovi") {
			$id_tabele = "id_troska";
		} elseif ($tabela == "porudzbine") {
			$id_tabele = "id_narudzbine";
		} elseif ($tabela == "proizvodi") {
			$id_tabele = "id_proizvoda";
		} elseif ($tabela == "admin") {
			$id_tabele = "id_admin";
		}

		$query = "DELETE FROM $tabela WHERE $id_tabele=$id AND id_korisnika=$id_korisnika";

		echo $tabela . "/" . $id . " / " . $id_korisnika . " / " . $query;

		$stmt = $this->db->prepare($query);
		$stmtArray = array();
		return $this->insert_data($query, $stmtArray, "bindParam");
	}

	public function change_status($tabela, $id, $status, $id_korisnika) {
		if ($tabela == "troskovi") {
			$id_tabele = "id_troska";
		} elseif ($tabela == "porudzbine") {
			$id_tabele = "id_narudzbine";
		} elseif ($tabela == "proizvodi") {
			$id_tabele = "id_proizvoda";
		} elseif ($tabela == "admin") {
			$id_tabele = "id_admin";
		}

		$query = "UPDATE $tabela SET status=:status WHERE $id_tabele=$id AND id_korisnika=$id_korisnika";

		echo $tabela . "/" . $id . " / " . $id_korisnika . " / " . $query;

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"status" => $status,
		);
		return $this->insert_data($query, $stmtArray, "bindParam");
	}

	public function verify_user($user_id) {

		$query = "UPDATE users SET activated=:activated WHERE user_id=:user_id";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"activated" => "1",
			"user_id" => $user_id,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}


/*STARO*/
	public function insert_new_faktura($broj_fakture, $id_korisnika, $kupac_id, $datum_prometa, $valuta, $ukupno, $username) {
		$query = "INSERT INTO fakture (broj_fakture, id_korisnika, kupac_id, datum_prometa, valuta, ukupno,  username, izvod, status) VALUES (:broj_fakture, :id_korisnika, :kupac_id, :datum_prometa, :valuta, :ukupno, :username, '0', :status)";
		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"broj_fakture" => $broj_fakture,
			"id_korisnika" => $id_korisnika,
			"kupac_id" => $kupac_id,
			"datum_prometa" => $datum_prometa,
			"valuta" => $valuta,
			"ukupno" => $ukupno,
			"username" => $username,
			"status" => $this->status,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function insert_new_izvod($broj_izvoda, $id_korisnika, $kupac_id, $username, $uplata, $datum_prometa) {
		$query = "INSERT INTO fakture (broj_izvoda, id_korisnika, kupac_id, datum_prometa, username, uplata, izvod, status) VALUES (:broj_izvoda, :id_korisnika, :kupac_id, :datum_prometa, :username, :uplata, '1', :status)";
		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"broj_izvoda" => $broj_izvoda,
			"id_korisnika" => $id_korisnika,
			"kupac_id" => $kupac_id,
			"datum_prometa" => $datum_prometa,
			"username" => $username,
			"uplata" => $uplata,
			"status" => $this->status,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function edit_faktura_by_id($broj_fakture, $datum_prometa, $valuta, $ukupno, $username, $id_fakture) {
		$query = "UPDATE fakture SET broj_fakture=:broj_fakture, datum_prometa=:datum_prometa, valuta=:valuta, ukupno=:ukupno, username=:username WHERE id_fakture=:id_fakture";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"broj_fakture" => $broj_fakture,
			"datum_prometa" => $datum_prometa,
			"valuta" => $valuta,
			"ukupno" => $ukupno,
			"username" => $username,
			"id_fakture" => $id_fakture,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function edit_izvod_by_id($broj_izvoda, $datum_prometa, $valuta, $uplata, $username, $id_fakture) {
		$query = "UPDATE fakture SET broj_izvoda=:broj_izvoda, datum_prometa=:datum_prometa, valuta=:valuta, uplata=:uplata, username=:username WHERE id_fakture=:id_fakture";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"broj_izvoda" => $broj_izvoda,
			"datum_prometa" => $datum_prometa,
			"valuta" => $valuta,
			"uplata" => $uplata,
			"username" => $username,
			"id_fakture" => $id_fakture,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function update_faktura($id_korisnika, $kupac_id, $broj_otpremnice, $broj_prijemnice, $nacin, $datumPrometa, $valuta, $datum, $mestoFakture, $artikliKomadi, $rabat, $slovima, $ukupno, $napomena, $br_predracuna, $username) {
		$query = "UPDATE fakture SET id_korisnika=:id_korisnika, kupac_id=:kupac_id, broj_otpremnice=:broj_otpremnice, broj_prijemnice=:broj_prijemnice, nacin=:nacin, datumPrometa=:datumPrometa, valuta=:valuta, datum=:datum, mestoFakture=:mestoFakture, artikliKomadi=:artikliKomadi, rabat=:rabat, slovima=:slovima, ukupno=:ukupno, napomena=:napomena, br_predracuna=:br_predracuna, status=:status  WHERE username=:username AND status='0'";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"id_korisnika" => $id_korisnika,
			"kupac_id" => $kupac_id,
			"broj_otpremnice" => $broj_otpremnice,
			"broj_prijemnice" => $broj_prijemnice,
			"nacin" => $nacin,
			"datumPrometa" => $datumPrometa,
			"valuta" => $valuta,
			"datum" => $datum,
			"mestoFakture" => $mestoFakture,
			"artikliKomadi" => $artikliKomadi,
			"rabat" => $rabat,
			"slovima" => $slovima,
			"ukupno" => $ukupno,
			"napomena" => $napomena,
			"br_predracuna" => $br_predracuna,
			"status" => $this->status,
			"username" => $username,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function update_faktura_by_id($broj_fakture, $id_korisnika, $kupac_id, $broj_otpremnice, $broj_prijemnice, $nacin, $datumPrometa, $valuta, $datum, $mestoFakture, $artikliKomadi, $rabat, $slovima, $ukupno, $napomena, $username, $uplata, $br_predracuna, $id_fakture) {
		$query = "UPDATE fakture SET broj_fakture=:broj_fakture, id_korisnika=:id_korisnika, kupac_id=:kupac_id, broj_otpremnice=:broj_otpremnice, broj_prijemnice=:broj_prijemnice, nacin=:nacin, datumPrometa=:datumPrometa, valuta=:valuta, datum=:datum, mestoFakture=:mestoFakture, artikliKomadi=:artikliKomadi, rabat=:rabat, slovima=:slovima, ukupno=:ukupno, napomena=:napomena, username=:username, uplata=:uplata, br_predracuna=:br_predracuna, status=:status  WHERE id_fakture=:id_fakture";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"broj_fakture" => $broj_fakture,
			"id_korisnika" => $id_korisnika,
			"kupac_id" => $kupac_id,
			"broj_otpremnice" => $broj_otpremnice,
			"broj_prijemnice" => $broj_prijemnice,
			"nacin" => $nacin,
			"datumPrometa" => $datumPrometa,
			"valuta" => $valuta,
			"datum" => $datum,
			"mestoFakture" => $mestoFakture,
			"artikliKomadi" => $artikliKomadi,
			"rabat" => $rabat,
			"slovima" => $slovima,
			"ukupno" => $ukupno,
			"napomena" => $napomena,
			"username" => $username,
			"uplata" => $uplata,
			"br_predracuna" => $br_predracuna,
			"status" => $this->status,
			"id_fakture" => $id_fakture,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function update_faktura_uplata($uplata, $id_fakture, $id_korisnika) {
		$query = "UPDATE fakture SET uplata=:uplata  WHERE id_fakture=:id_fakture AND id_korisnika=:id_korisnika";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"uplata" => $uplata,
			"id_fakture" => $id_fakture,
			"id_korisnika" => $id_korisnika,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function update_kupca($naziv_kupca, $adresa_kupca, $mesto_kupca, $pib_kupca, $mat_broj, $ziro_racun, $email, $status_kupca, $id_kupca, $id_korisnika) {
		$query = "UPDATE kupci SET naziv_kupca=:naziv_kupca, adresa_kupca=:adresa_kupca, mesto_kupca=:mesto_kupca, pib_kupca=:pib_kupca, mat_broj=:mat_broj, ziro_racun='$ziro_racun', email='$email', status_kupca=:status_kupca  WHERE id_kupca=:id_kupca AND id_korisnika=:id_korisnika";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"naziv_kupca" => $naziv_kupca,
			"adresa_kupca" => $adresa_kupca,
			"mesto_kupca" => $mesto_kupca,
			"pib_kupca" => $pib_kupca,
			"mat_broj" => $mat_broj,
			"status_kupca" => $status_kupca,
			"id_kupca" => $id_kupca,
			"id_korisnika" => $id_korisnika,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function insert_new_kupac($id_korisnika, $naziv_kupca, $adresa_kupca, $mesto_kupca, $pib_kupca, $mat_broj, $ziro_racun, $email) {

		$query = "INSERT INTO kupci (id_korisnika, naziv_kupca,adresa_kupca,mesto_kupca,pib_kupca,mat_broj, ziro_racun, email, status_kupca) VALUE(:id_korisnika, :naziv_kupca, :adresa_kupca, :mesto_kupca, :pib_kupca, :mat_broj, :ziro_racun, :email, :status_kupca)";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"id_korisnika" => $id_korisnika,
			"naziv_kupca" => $naziv_kupca,
			"adresa_kupca" => $adresa_kupca,
			"mesto_kupca" => $mesto_kupca,
			"pib_kupca" => $pib_kupca,
			"mat_broj" => $mat_broj,
			"ziro_racun" => $ziro_racun,
			"email" => $email,
			"status_kupca" => $this->status,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

/*
public function insert_artikal($id_korisnika,$artikal,$jedinica_mere,$cena,$pdv){
$query = "INSERT INTO artikli (id_korisnika, artikal, jedinica_mere, cena, pdv, status_artikla) VALUE (:id_korisnika, :artikal, :jedinica_mere, :cena, :pdv, :status_artikla)";

$stmt = $this->db->prepare($query);
$stmtArray = array(
"id_korisnika" => $id_korisnika,
"artikal" => $artikal,
"jedinica_mere" => $jedinica_mere,
"cena" => $cena,
"pdv" => $pdv,
"status_artikla" => $this->status
);

return $this->insert_data($query,$stmtArray,"bindValue");
}
 */

	public function update_artikla($artikal, $jedinica_mere, $cena, $pdv, $status_artikla, $id_artikla, $id_korisnika) {
		$query = "UPDATE artikli SET artikal=:artikal, jedinica_mere=:jedinica_mere, cena=:cena, pdv=:pdv, status_artikla=:status_artikla  WHERE id_artikla=:id_artikla AND id_korisnika=:id_korisnika";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"artikal" => $artikal,
			"jedinica_mere" => $jedinica_mere,
			"cena" => $cena,
			"pdv" => $pdv,
			"status_artikla" => $status_artikla,
			"id_artikla" => $id_artikla,
			"id_korisnika" => $id_korisnika,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function insert_korisnika($korisnik, $adresa, $mesto, $maticni_broj, $pib, $sifra_delatnosti, $telefon, $fax, $tekuci_racun, $banka, $logo, $dodatak_broju, $status) {
		$query = "INSERT INTO korisnici (korisnik, adresa, mesto, maticni_broj, pib, sifra_delatnosti, telefon, fax, tekuci_racun, banka, logo, dodatak_broju, status) VALUE (:korisnik, :adresa, :mesto, :maticni_broj, :pib, :sifra_delatnosti, :telefon, :fax, :tekuci_racun, :banka, :logo, :dodatak_broju, :status)";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"korisnik" => $korisnik,
			"adresa" => $adresa,
			"mesto" => $mesto,
			"maticni_broj" => $maticni_broj,
			"pib" => $pib,
			"sifra_delatnosti" => $sifra_delatnosti,
			"telefon" => $telefon,
			"fax" => $fax,
			"tekuci_racun" => $tekuci_racun,
			"banka" => $banka,
			"logo" => $logo,
			"dodatak_broju" => $dodatak_broju,
			"status" => $status,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function update_korisnika($korisnik, $adresa, $mesto, $maticni_broj, $pib, $sifra_delatnosti, $telefon, $fax, $tekuci_racun, $banka, $logo, $dodatak_broju, $status, $id_korisnika) {
		$query = "UPDATE korisnici SET korisnik=:korisnik, adresa=:adresa, mesto=:mesto, maticni_broj=:maticni_broj, pib=:pib, sifra_delatnosti=:sifra_delatnosti, telefon=:telefon, fax=:fax, tekuci_racun=:tekuci_racun, banka=:banka, logo=:logo, dodatak_broju=:dodatak_broju, status=:status  WHERE id_korisnika=:id_korisnika ";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"korisnik" => $korisnik,
			"adresa" => $adresa,
			"mesto" => $mesto,
			"maticni_broj" => $maticni_broj,
			"pib" => $pib,
			"sifra_delatnosti" => $sifra_delatnosti,
			"telefon" => $telefon,
			"fax" => $fax,
			"tekuci_racun" => $tekuci_racun,
			"banka" => $banka,
			"logo" => $logo,
			"dodatak_broju" => $dodatak_broju,
			"status" => $status,
			"id_korisnika" => $id_korisnika,
		);
	}

	public function update_admina($username, $upisPassworda, $status, $id_admin, $id_korisnika) {
		$query = "UPDATE admin SET username=:username, $upisPassworda status=:status WHERE id_admin=:id_admin AND id_korisnika=:id_korisnika";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"username" => $username,
			"status" => $status,
			"id_admin" => $id_admin,
			"id_korisnika" => $id_korisnika,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}

	public function insert_admin($username, $password, $id_korisnika, $status) {
		$query = "INSERT INTO admin (username, password, id_korisnika, status) VALUE (:username, :password, :id_korisnika, :status)";

		$stmt = $this->db->prepare($query);
		$stmtArray = array(
			"username" => $username,
			"password" => $password,
			"id_korisnika" => $id_korisnika,
			"id_korisnika" => $id_korisnika,
		);

		return $this->insert_data($query, $stmtArray, "bindValue");
	}
}