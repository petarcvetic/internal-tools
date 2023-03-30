<?php

	require_once"connect.inc.php";
	spl_autoload_register(function($ime_klase){
		require_once "classes/class.{$ime_klase}.inc.php";
	});

	$database = new Database();
	$ind = new Indexing();
	$noind = new Noindexing();

	//Slanje izvestaja na mejl
	function send_email($txt){
		$to = "itexecdigi@gmail.com, slp@executive-digital.com, pc@executive-digital.com, pk@executive-digital.com";
		$subject = "Indexing alert FORGE";
		$headers = "From: forge@tools.execdigi.com" . "\r\n" . "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=iso-8859-1" . "\r\n";

		mail($to,$subject,$txt,$headers);
	}



	//Popunjavanje tabele indeksiranih sajtova i provera 
	$i = 1;
	$x = 0;
	$y = 0;
	$indexing_error_x = "";
	$indexing_error_y = "";
	$error_message_x = "";
	$error_message_y = "";
	$message = "";
	$timestamp = "Schedule test: " . date("H:i, d.m.Y.", time());
//	$timestamp = "Izveštaj za: " . date("d-m-Y h:i:sa");

	$indexing_list = $ind->getIndexingList();

	foreach ($indexing_list as $indexing_site) {
		$site_url = $indexing_site[1];

		$indexing = $ind->check_indexing($site_url);
		if($indexing == "1"){
			$x++;
			$indexing_error_x .= $site_url. "\r\n";
		}
	}



	$noindexing_list = $noind->getNoindexingList();

	foreach ($noindexing_list as $noindexing_site) {
		$site_url = $noindexing_site[1];

		$noindexing = $noind->check_indexing($site_url);

		if($noindexing == "0"){
			$y++;
			$indexing_error_y .= $site_url. "\r\n";
		}
	}

	if($x != 0){
		if($x != 1){
			$error_message_x = "<strong>Sajtovi koji se ne indeksiraju a trebalo bi:</strong> "."\r\n". $indexing_error_x;
		}
		else{
			$error_message_x = "<strong>Sajt koji se ne indeksira a trebalo bi:</strong> "."\r\n". $indexing_error_x;
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

	if($error_message_x != "" ||  $error_message_y !== ""){
		$message = $timestamp . "\r\n" . $error_message_x . "\r\n" . $error_message_y;
		send_email($message);
	}	

?>
