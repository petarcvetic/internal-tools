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
	
	<select name="user_team" required>
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

</form>