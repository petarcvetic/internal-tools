<?php  
	$active1 = "";
	$active2 = "";
	$active3 = "active";
	$path = "../";

	require_once"connect.inc.php";
	spl_autoload_register(function($ime_klase){
		require_once "classes/class.{$ime_klase}.inc.php";
	});

	$database = new Database();
	$ind = new Indexing();
	$noind = new Noindexing();

	//Dodavanje sajta na listu indexiranih sajtova
	if(isset($_POST["add_indexing"])){
		if($_POST["indexing_url"] != ""){
			$indexing_url = strip_tags($_POST["indexing_url"]);
			
			if (strpos($indexing_url, 'http') !== false && strpos($indexing_url, '.') !== false) {
				$check_url = $ind->getIndexedSite($indexing_url);
				if($check_url == ""){
					$ind->insert_indexing_url($indexing_url, "1");
				}
				else{
					echo "<script> alert('Ovaj sajt je vec na listi indeksirajucih sajtova');</script>";
				}
			}
			else{
				echo "<script type='text/javascript'>alert('URL mora da sadrži prefiks http://'); </script>";
			}
		}
	}

	//Dodavanje sajta na listu neindexiranih sajtova
	if(isset($_POST["add_noindexing"])){
		if($_POST["noindexing_url"] != ""){
			$noindexing_url = strip_tags($_POST["noindexing_url"]);
			
			if (strpos($noindexing_url, 'http') !== false && strpos($noindexing_url, '.') !== false) {
				$check_url = $noind->getNoindexedSite($noindexing_url);
				if($check_url == ""){
					$noind->insert_noindexing_url($noindexing_url, "1");
				}
				else{
					echo "<script> alert('Ovaj sajt je vec na listi neindeksirajucih sajtova');</script>";
				}
			}
			else{
				echo "<script type='text/javascript'>alert('URL mora da sadrži prefiks http://'); </script>";
			}
		}
	}

	//Editovanje URL-a
	if(isset($_POST["edit_url"])){
		$edited_url = strip_tags($_POST["edited_url"]);
		$type = strip_tags($_POST["type"]);
		$id = strip_tags(($_POST["id"]));

		if($edited_url != ""){
			if(strpos($edited_url, 'http') !== false && strpos($edited_url, '.') !== false){
				if($type == "indexing"){
					$check_url = $ind->getIndexedSite($edited_url);
					if($check_url == ""){
						$ind->edit_URL($id,$edited_url);
					}
					else{
						echo "<script> alert('Ovaj sajt je vec na listi indeksirajucih sajtova');</script>";
					}
				}
				else if($type == "noindexing"){
					$check_url = $noind->getNoindexedSite($edited_url);
					if($check_url == ""){
						$noind->edit_URL($id,$edited_url);
					}
					else{
						echo "<script> alert('Ovaj sajt je vec na listi neindeksirajucih sajtova');</script>";
					}
				}
				else{
					echo "<script> alert('Doslo je do greske');</script>";
				}
			}
			else{
				echo "<script> alert('Neipravan URL (URL mora sadrzati http i domen');</script>";
			}
		}
	}



	require_once"header.php";
?>

<div class="container">

	<div class="row">
		<div class="col-sm-6">
			<form action="" method="post">
				<label for="indexing_url">Indexing</label>
				<input type="text" name="indexing_url" id="indexing_url" class="" placeholder="Insert URL of indexing site">
				<input type="submit" name="add_indexing" class="btn btn-success" value="ADD">
			</form>
		</div>

		<div class="col-sm-6">
			<form action="" method="post">
				<label for="male">Nondexing</label>
				<input type="text" name="noindexing_url" id="noindexing_url" class="" placeholder="Insert URL of noindexing site">
				<input type="submit" name="add_noindexing" class="btn btn-success" value="ADD">
			</form>
		</div>
	</div><!--end .row-->
	
	<div class="row">

		<div class="col-sm-6">
			<table class="table">
				<thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Indexing Sites</th>
					  <th scope="col"></th>
				    </tr>
				 </thead>

				 <tbody>
			<?php
			//Popunjavanje tabele indeksiranih sajtova i provera 
				$i = 1;

				$indexing_list = $ind->getIndexingList();

				foreach ($indexing_list as $indexing_site) {
					$site_url = $indexing_site[1];
					$site_id = $indexing_site[0];

					echo"<tr id='ind".$i."'>
							<td>". $i ."</td>
							<td id='td".$i."'><a href='".$site_url."'>". $site_url ."</a></td>
							<td><i class='fa fa-wrench' style='font-size:24px' onclick='edit_url(".'"td'.$i.'",'.'"indexing",'.$site_id.',"'.$site_url.'"'.")'></i></td>
							<td><i class='fa fa-times-rectangle' style='font-size:24px;color:red' onclick='delete_site(".'"ind'.$i.'",'.'"indexing",'.$site_id.")'></i></td>
						</tr>";
					$i++;
				}
				
				
		//		send_email("Sajt ".$site_url." se ne indeksita, a trebao bi");
			?>
				</tbody>
			</table>
		</div>

		<div class="col-sm-6">

			<table class="table">
				<thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Noidexing Sites</th>
					  <th></th>
				    </tr>
				 </thead>

				 <tbody>
			<?php
			//Popunjavanje tabele neindeksiranih sajtova i provera
				$i = 1;
				
				$noindexing_list = $noind->getNoindexingList();
				foreach ($noindexing_list as $noindexing_site) {
					$site_url = $noindexing_site[1];
					$site_id = $noindexing_site[0];
					
					echo"<tr id='noind".$i."'>
							<td>". $i ."</td>
							<td id='notd".$i."'><a href='".$site_url."'>". $site_url ."</a></td>
							<td><i class='fa fa-wrench' style='font-size:24px' onclick='edit_url(".'"notd'.$i.'",'.'"noindexing",'.$site_id.',"'.$site_url.'"'.")'></i></td>
							<td><i class='fa fa-times-rectangle' style='font-size:24px;color:red' onclick='delete_site(".'"noind'.$i.'",'.'"noindexing",'.$site_id.")'></i></td>
						</tr>";
					$i++;
				}
				
			?>
				</tbody>
			</table>

		</div>

	</div><!--end .rov-->
	
</div> <!-- end .container -->

<script type="text/javascript">
	// funkcija za brisanje URL-a
	function delete_site(trId,type,id){

		$.get( "delete.php?type="+type+"&id="+id, function( data ) {
			if(data == "DONE"){
				$("#"+trId).css("display", "none");
			}
		});

	}

	//Funkcija za editovanje URL-a
	function edit_url(tdId,type,id,site_url){
		var hiden_inputs = "<input type='hidden' name='type' value='"+type+"'><input type='hidden' name='id' value='"+id+"'>";
		var form = "<form action='' method='post'>"+hiden_inputs+"<input type='text' name='edited_url' value='"+site_url+"' size='34'><button type='submit' name='edit_url' class='btn btn-success' >EDIT</button></form>";
		
		$("#pop-up").css({"background-color": "rgba(155, 155, 155, 0.5)", "width": "100%", "height": "100%", "position": "fixed", "z-index": "1000", "visibility": "visible", "opacity": "1", "transition": "opacity 1s linear"});

		//create and input div #edit-popup into #pop-up div
		$("#pop-up").html("<div id='edit-popup'><div id='popup-head' class=''><i class='fa fa-times-rectangle' style='font-size:24px;color:red' onclick='hide("+'"pop-up"'+")'></i> <h2>Edit URL</h2></div><div id='popup-content'></div></div>");

		$("#edit-popup").css({"background-color": "white", "width": "30%", "height": "20%", "position": "relative", "top": "35%", "left": "35%"});

		$("#popup-content").html(form);
	}

	function hide(id){
		$("#"+id).css({"visibility": "hidden", "opacity": "0", "transition": "visibility 0s 1s, opacity 1s linear"});
	}

</script>

<?php
	require_once"footer.php";
?>