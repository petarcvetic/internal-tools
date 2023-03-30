<?php  
	//aktivna stranica u meniju
	$active1 = "active";
	$active2 = "";
	$active3 = "";

	
	require_once"connect.inc.php";
	spl_autoload_register(function($ime_klase){
		require_once "classes/class.{$ime_klase}.inc.php";
	});

	$database = new Database();
	$ind = new Indexing();
	$noind = new Noindexing();

	//Slanje izvestaja na mejl
	function send_email($txt){
		$to = "pc@executive-digital.com";
		$subject = "My subject";
		$headers = "From: webmaster@example.com" . "\r\n" ."CC: ds@executive-digital.com";

		mail($to,$subject,$txt,$headers);
	}

	
	require_once"header.php";
?>

<div class="container">

	<div class="row">
<!--		
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
				    </tr>
				 </thead>

				 <tbody>
					<?php
					//Popunjavanje tabele indeksiranih sajtova
						$i = 1;

						$indexing_list = $ind->getIndexingList();

						foreach ($indexing_list as $indexing_site) {
							$site_url = $indexing_site[1];

							echo"<tr id='ind".$indexing_site[0]."'>
									<td>". $i ."</td>
									<td>". $site_url ."</td>
								</tr>";
							$i++;
						}
					?>
				</tbody>
			</table>
		</div>

		<div class="col-sm-4">

			<table class="table">
				<thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Noidexing Sites</th>
				    </tr>
				 </thead>

				 <tbody>
					<?php
					//Popunjavanje tabele neindeksiranih sajtova
						$i = 1;

						$noindexing_list = $noind->getNoindexingList();

						foreach ($noindexing_list as $noindexing_site) {
							$site_url = $noindexing_site[1];
							
							echo"<tr id='noind".$noindexing_site[0]."'>
									<td>". $i ."</td>
									<td>". $site_url ."</td>
								</tr>";
							$i++;
						}
						
					?>
				</tbody>
			</table>

		</div>

	</div><!--end .rov-->

	<script type="text/javascript">


		<?php
			$js_array_indexing = json_encode($indexing_list);
			echo "var indexing_list = " . $js_array_indexing . ";\n";

			$js_array_noindexing = json_encode($noindexing_list);
			echo "var noindexing_list = " . $js_array_noindexing . ";\n";
		?>

		indexing_list.forEach(function(indexing_site) {
			var id = indexing_site[0];
			var site_url = indexing_site[1];

			$.get( "check.php?type=indexing&site_url="+site_url, function( data ) {
				if(data == "indexing"){
					$("#ind"+id).css("background-color", "red");
				}
				else if(data == "noindexing"){
					$("#ind"+id).css("background-color", "green");
				}
			});
		});

		noindexing_list.forEach(function(noindexing_site) {
			var id = noindexing_site[0];
			var site_url = noindexing_site[1];

			$.get( "check.php?type=noindexing&site_url="+site_url, function( data ) {
				if(data == "indexing"){
					$("#noind"+id).css("background-color", "red");
				}
				else if(data == "noindexing"){
					$("#noind"+id).css("background-color", "green");
				}
			});
		});

		

	</script>

</div><!--end .container -->

<?php

	require_once"footer.php";
?>