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