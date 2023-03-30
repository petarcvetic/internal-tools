<?php
require_once"connect.inc.php";
	spl_autoload_register(function($ime_klase){
		require_once "classes/class.{$ime_klase}.inc.php";
	});

	$database = new Database();
	$noind = new Noindexing();

	//Slanje izvestaja na mejl
	function send_email($txt){
		$to = "pc@executive-digital.com, slp@executive-digital.com, ds@executive-digital.com, dn@executive-digital.com";
		$subject = "Indexing alert";
		$headers = "From: forge@tools.execdigi.com" . "\r\n" . "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=iso-8859-1" . "\r\n";

		mail($to,$subject,$txt,$headers);
	}


	function testSits(){
		$database = new Database();
		$noind = new Noindexing();
		//Popunjavanje tabele indeksiranih sajtova i provera 
		$i = 1;
		$y = 0;

		$indexing_error_y = "";
		$error_message_y = "";
		$message = "";
	//	$timestamp = "Izveštaj za: " . date("H:i, d.m.Y.", time());
		$timestamp = "Izveštaj za: " . date("d-m-Y h:i:sa");


		$noindexing_list = $noind->getNoindexingList();

		foreach ($noindexing_list as $noindexing_site) {
			$site_url = $noindexing_site[1];

			$noindexing = $noind->check_indexing($site_url);

			if($noindexing == "0"){
				$y++;
				$indexing_error_y .= $site_url. "\r\n";
			}
		}


		if($y != 0){
			if($y != 1){
				$error_message_y = "<b>Sajtovi koji se indeksiraju a ne bi trebalo:</b> "."\r\n". $indexing_error_y;
			}
			else{
				$error_message_y = "<b>Sajt koji se indeksira a ne bi trebalo:</b> "."\r\n". $indexing_error_y;
			}
		}

		if($error_message_y !== ""){
			$message = $timestamp . "\r\n" .  $error_message_y;
			send_email($message);
		}
	}//END testSites();	

	try{
		testSits();
		send_email("DONE");
	}
	catch(Exception $e){
		$error = $e->getMessage();
		send_email("Test ERROR".$error);
	}

?>
