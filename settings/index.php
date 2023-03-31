<?php

	$project_id = "";
	$path = "../";
	include $path."dbconfig.php";

	/*AKO USER NIJE ULOGOVAN (ako ne postoji sesija sess_user_id*/
	if ($user->is_loggedin() == "" or $_SESSION['sess_user_status']<3) {
		header('Location: '.$path);
	}

	include $path."assets/header.php";

//	$user->sned_mail_now("petar.cvetic@gmail.com","petar.cvetic@gmail.com","test","neki tekst");

	/*KLIKNUTO JE DUGME ADD SITE*/
	if(isset($_POST['add_site']) && $_SESSION['sess_user_status']>3){

		if(isset($_POST["project"]) && $_POST['project']!='0'){
			$project_id = strip_tags($_POST["project"]);
		}
		elseif ($_POST['project_name']!="") {
			$project_name = strip_tags($_POST['project_name']);
			$teamwork_link = strip_tags($_POST['teamwork_link']);
			$client_email = strip_tags($_POST['client_email']);

			/*Ako projekta nema u bazi upisuje se novi projekat*/
			if($getData->if_project_exists_by_name($project_name)==0){
				$insertData->insert_project($project_name, $teamwork_link, $client_email);
				$project_id = $getData->get_poslednji_projekat()['project_id'];
			}
			else{
				echo "<script>alert('Projekat ".$project_name." vec postoji u bazi, odaberite ga iz padajuceg menija');</script>";
			}
			
		}
		else{
			echo "<script>alert('Da biste dodali sajt morate ga dodeliti nekom projektu');</script>";
		}

		if($project_id != "" AND $getData->if_project_exists_by_id($project_id)!=0){
			$live_url = strip_tags($_POST['live_url']);
			$live_username = strip_tags($_POST['live_username']);
			$live_password = strip_tags($_POST['live_password']);

			$stage_url = strip_tags($_POST['stage_url']);
			$stage_username = strip_tags($_POST['stage_username']);
			$stage_password = strip_tags($_POST['stage_password']);


			/*Unos LIVE-a*/
			if($live_url != "" && $live_username != "" && $live_password != ""){
				if($getData->if_website_exists_by_url("live",$live_url)==0){
					$insertData->insert_webslite_live($project_id, $live_url, $live_username, $live_password );
				}
				else{
					echo "<script>alert('URL za live (".$live_url.") vec postoji u bazi');</script>";
				}
				
			}

			/*Unos STAGE-a*/
			if($stage_url != "" && $stage_username != "" && $stage_password != ""){
				if($getData->if_website_exists_by_url("stage",$stage_url)==0){
					$insertData->insert_webslite_stage($project_id, $stage_url, $stage_username, $stage_password );
				}
				else{
					echo "<script>alert('URL za stage ".$stage_url." vec postoji u bazi');</script>";
				}
				
			}
		}

	}

	/* KLIKNUTO JE DUGME "ADD USER" */
	if(isset($_POST["add_user"]) && $_SESSION['sess_user_status']>3){
		if($_POST['username']!="" && $_POST["password"]!="" && $_POST["email"]!="" && $_POST["first_name"]!="" && $_POST["last_name"]!="" && $_POST["team"]!="" && $_POST["status"]!="" ){

			$username = strip_tags($_POST["username"]);
			$password = sha1(strip_tags($_POST["password"]));
			$email  = strip_tags($_POST["email"]);
			$first_name = strip_tags($_POST["first_name"]);
			$last_name = strip_tags($_POST["last_name"]);
			if(isset($_POST['skype'])){
				$skype  = strip_tags($_POST["skype"]);
			}
			else{$skype  = "";}
			$team = strip_tags($_POST["team"]);
			$status = strip_tags($_POST["status"]);

			/*AKO UNETI USERNAM I PASSEORD VEC NISU UNETI NOVI USER SE UPISUJE U BAZU*/
			if($getData->if_username_exists($username, $email)==0 && $getData->if_user_mail_exists($email)==0){
				$user->register($username,$password,$email,$first_name,$last_name,$skype,$team,$status);
				echo "<script>alert('The user <b>".$username."</b> has been added to the database');</script>";
			}
			else{
				if($getData->if_username_exists($username, $email)>0){
					echo "<script>alert('The username ".$username." is taken');</script>";
				}

				if($getData->if_user_mail_exists($email)>0){
					echo "<script>alert('The username with email ".$email." already exists');</script>";
				}
			}

		}
		else{
			echo "<script>alert('The input fields with satars are required');</script>";
		}
	}

	$projects = $getData->get_all_projects();
	$live_sites = $getData->get_all_sites("live_sites");
	$stage_sites = $getData->get_all_sites("stage_sites");
	$users = $getData->get_all_users();
?>
	

	<div class="container">

<?php 
if($_SESSION['sess_user_status']>3){
?>
	
		<div class="sidebar-fixed">
			<button class="submit" id="sites-btn" onclick="display_option('sites')">SITES/PROJECTS</button><br>
			<button class="submit" id="users-btn" onclick="display_option('users')">USERS</button><br>
			<button class="submit" id="tools-btn" onclick="display_option('tools')">TOOLS</button><br>
			
		</div>

		<div class="hidden" id="sites">
			<form method="post" action="">
				PROJECT:
				<select name="project" id="project" onchange="check_project_toggle(this)">
					<option value="0" selected>Choose The Project</option>
					<?php 
					foreach ($projects as $project) {
						echo "<option value='".$project['project_id']."'>".$project['project_name']."</option>";
					}
					?>
				</select>
				<br>
				<div id="new-project-btn" class="submit" onclick="new_project_form()">NEW PROJECT</div>
				<br>
				<div id="toggle_hide">
					Add new project:<br> 
					<input type="text" name="project_name" id="project_name" placeholder="Project Name">
					<input type="text" name="teamwork_link" id="teamwork_link" placeholder="TeamWork Link">
					<input type="email" name="client_email" id="client_email" placeholder="Client's Email">
					<div class="btn btn-danger"  onclick="check_project_toggle(1)">X</div>
				</div>

				<br><br>
				LIVE:<br>
				<input type="text" name="live_url" id="live_url" placeholder="URL (without 'wp-admin')">
				<input type="text" name="live_username" id="live_username" placeholder="Username">
				<input type="text" name="live_password" id="live_password" placeholder="Password">

				<br><br>
				STAGE:<br>
				<input type="text" name="stage_url" id="stage_url" placeholder="URL (without 'wp-admin')">
				<input type="text" name="stage_username" id="stage_username" placeholder="Username">
				<input type="text" name="stage_password" id="stage_password" placeholder="Password">

				<div class="right-button">
					<input type="submit" name="add_site" id="add_site" class="submit" value="ADD">
				</div>

			</form>
			<br><br>

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
						$live_site = $getData->get_site_by_project_id("live_sites",$project["project_id"])["live_url"];
					}else{$live_site = "";}
					
					if($getData->get_site_by_project_id("stage_sites",$project["project_id"])){
						$stage_site = $getData->get_site_by_project_id("stage_sites",$project["project_id"])["stage_url"];
					}
					else{$stage_site = "";}

					echo "
					<tr>
						<td>".$i."</td>
						<td>".$project['project_name']."</td>
						<td><a href='$live_site' target='_blank'>".$live_site."</a></td>
						<td><a href='$stage_site' target='_blank'>".$stage_site."</a></td>
						<td>".$project['status']."</td>
					</tr>
					";
					$i++;
				}
				?>
				</table>
			</div><!--END projects-->
		</div><!--END Sites-->


		<div class="hidden" id="users">
			<form method="post" action="">
				ADD NEW USERS<br>
				<input type="text" name="first_name" placeholder="First Name*" required>
				<input type="text" name="last_name" placeholder="Last Name*" required><br><br>
				<input type="text" name="username" placeholder="Username*" required>
				<input type="text" name="password" placeholder="Password*" required><br><br>
				<input type="email" name="email" placeholder="E-mail*" required>
				<input type="text" name="skype" placeholder="Skype Name"><br><br>
				
				<select name="status" required>
					<option value="" selected disabled>Chose a role*</option>
					<option value="1">User</option>
					<option value="2">Editor</option>
					<option value="3">Admin</option>
					<option value="4">Super-admin</option>
				</select><br>
				
				<select name="team" required>
					<option value="" selected disabled>Chose a team*</option>
					<option value="seo">SEO</option>
					<option value="social">SOCIAL MEDIA</option>
					<option value="dev">DEV</option>
					<option value="link">LINK BUILDING</option>
					<option value="content">CONTENT WRITING</option>
					<option value="it">IT</option>
					<option value="pm">PM</option>
				</select>

				<div class="right-button">
					<input type="submit" name="add_user" id="add_user" class="submit" value="ADD USER">
				</div>

			</form><br><br>

			<table>
				<tr>
					<th></th>
					<th>FIRST NAME</th>
					<th>LAST NAME</th>
					<th>USERNAME</th>
					<th>EMAIL</th>
					<th>SKYPE</th>
					<th>TEAM</th>
					<th>ROLE</th>
				</tr>
			<?php
			$i = 1; 
			foreach ($users as $user) {
				if($user['status'] == "0"){$role = "Blocked";}
				elseif($user['status'] == "1"){$role = "User";}
				elseif($user['status'] == "2"){$role = "Editor";}
				elseif($user['status'] == "3"){$role = "Admin";}
				elseif($user['status'] == "4"){$role = "Super-admin";}
				elseif($user['status'] == "5"){$role = "Bogotac :)";}
				else{$role = "Role missing";}
				echo "
				<tr>
					<td>".$i."</td>
					<td>".$user['first_name']."</td>
					<td>".$user['last_name']."</td>
					<td>".$user['username']."</td>
					<td>".$user['email']."</td>
					<td>".$user['skype']."</td>
					<td>".$user['team']."</td>
					<td>".$role."</td>
				</tr>
				";
				$i++;
			}
			?>
			</table>
		</div><!--END Users-->


		<div class="hidden" id="tools">
			<form method="post" action="">
				<input type="checkbox" value="seo"> SEO

				<br><br>
				TOOL:<br>
				<input type="text" name="tool_url" id="tool_url" placeholder="URL for login">
				<input type="text" name="tool_username" id="tool_username" placeholder="Username">
				<input type="text" name="tool_password" id="tool_password" placeholder="Password">

				<div class="right-button">
					<input type="submit" name="add_site" id="add_site" class="submit" value="ADD">
				</div>

			</form>
			<br><br>

			
		</div><!--END tools-->
<?php 
}
?>



	</div><!--end .container -->

<?php
	require_once $path."assets/footer.php";
?>


<script>
	function display_option(option){
		$(".hidden").css("display","none");
		$("#"+option).css("display","block");
	}


	function check_project_toggle(option){

		if(isNaN(option)){
			var option = option.value;
		}
		
		if(option != 0){
			$("#project_name,#teamwork_link,#client_email").val("");
			$("#toggle_hide").css("display","none");
			$("#new-project-btn").css("display","block");
		}
		else{
			$("#toggle_hide").css("display","block");
		}
	}


	function new_project_form(){
		$('#project>option:eq(0)').prop('selected', true);

		$("#toggle_hide").css("display","block");

		$("#new-project-btn").css("display","none");
	}
</script>
