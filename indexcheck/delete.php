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
		$id = strip_tags($_GET["id"]);
		
		if($type == "indexing"){
			if($ind->deleteURL($id)){
				echo "DONE";
			}
			else{
				echo "ERROR";
			}
		}
		else if($type == "noindexing"){
			if($noind->deleteURL($id)){
				echo "DONE";
			}
			else{
				echo "ERROR";
			}
		}
		else{
			return false;
		}
		
		
	}
	else{
		echo "ERROR";
	}
	

?>