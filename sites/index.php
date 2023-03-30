<?php

	$project_id = "";
	$path = "../";
	include $path."dbconfig.php";

	/*AKO USER NIJE ULOGOVAN (ako ne postoji sesija sess_user_id*/
	if ($user->is_loggedin() == "" or $_SESSION['sess_user_status']<4) {
		header('Location: '.$path);
	}

	include $path."assets/header.php";

	$projects = $getData->get_all_projects();
	$live_sites = $getData->get_all_sites("live_sites");
	$stage_sites = $getData->get_all_sites("stage_sites");
	$users = $getData->get_all_users();
?>

<div class="container">

	<div class="projects">

		<table>
			<tr>
				<th></th>
				<th>PROJECT</th>
				<th>LIVE</th>
				<th>STAGE</th>
				<th>STATUS</th>
			</tr>
		<?php
		$i = 1; 
		foreach ($projects as $project) {
			if($getData->get_site_by_project_id("live_sites",$project["project_id"])){
				$live_site = $getData->get_site_by_project_id("live_sites",$project["project_id"]);
			}else{$live_site = "";}
			
			if($getData->get_site_by_project_id("stage_sites",$project["project_id"])){
				$stage_site = $getData->get_site_by_project_id("stage_sites",$project["project_id"])["stage_url"];
			}
			else{$stage_site = "";}

			echo "
			<tr>
				<td>".$i."</td>
				<td>".$project['project_name']."</td>
				<td>
			";
			if($getData->get_site_by_project_id("live_sites",$project["project_id"])){
				echo "
					<form action='".$live_site['live_url']."wp-login.php?wpe-login=true' method='post' target='_blank'>
					    <input type='hidden' name='log' value='".$live_site['live_username']."'>
					    <input type='hidden' name='pwd' value='".$live_site['live_password']."'>
					    <input type='submit' name='submit' value='LOGIN'>
					</form>
				";
			}

			echo "
				</td>
				<td><a href='$stage_site' target='_blank'>".$stage_site."</a></td>
				<td>".$project['status']."</td>
			</tr>
			";
			$i++;
		}
		?>
		</table>
	</div><!--END projects-->

</div><!--end .container -->

<?php
	require_once $path."assets/footer.php";
?>