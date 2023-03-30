<?php 
	require_once"connect.inc.php";
	spl_autoload_register(function($ime_klase){
		require_once "classes/class.{$ime_klase}.inc.php";
	});

	$database = new Database();
	$ind = new Indexing();
	$noind = new Noindexing();


	if(isset($_GET["type"])){

		$type = strip_tags($_GET["type"]);
		$url = strip_tags($_GET["site_url"]);

		if($type == "indexing"){
			$indexing = $ind->check_indexing($url);

			if($indexing == "error"){
				echo "error";
			}

			else if($indexing == "0"){
				echo "noindexing";
			}

			else if($indexing == "1"){
				echo "indexing";
			}
		}

		if($type == "noindexing"){
			$noindexing = $noind->check_indexing($url);

			if($noindexing == "error"){
				echo "error";
			}

			else if($noindexing == "0"){
				echo "indexing";
			}

			else if($noindexing == "1"){
				echo "noindexing";
			}

		}

	}



?>