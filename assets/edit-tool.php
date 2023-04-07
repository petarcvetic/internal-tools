<form method="post" action="">
	<b>Select the teams that will use the tool*</b><br>

	<input type="checkbox" name="edit_team[]" id="edit_seo_team" value="SEO"> SEO <br>
	<input type="checkbox" name="edit_team[]" id="edit_social_team" value="SOCIAL"> SOCIAL MEDIA <br>
	<input type="checkbox" name="edit_team[]" id="edit_dev_team" value="DEV"> DEV <br>
	<input type="checkbox" name="edit_team[]" id="edit_linkbuilding_team" value="LINK"> LINK BUILDING <br>
	<input type="checkbox" name="edit_team[]" id="edit_content_team" value="CONTENT"> CONTENT WRITING <br>
	<input type="checkbox" name="edit_team[]" id="edit_it_team" value="IT"> IT <br>
	<input type="checkbox" name="edit_team[]" id="edit_pm_team" value="PM"> PM <br>

	<br><br>
	<b>EDIT TOOL:</b><br>
	<input type="hidden" name="edit_tool_id" id="edit_tool_id">
	<input type="text" name="edit_tool_name" id="edit_tool_name" placeholder="Tool name" required>
	<input type="text" name="edit_tool_url" id="edit_tool_url" placeholder="URL for login" required><br>
	<input type="text" name="edit_tool_username_key" id="edit_tool_username_key" placeholder="Username KEY" required>
	<input type="text" name="edit_tool_username" id="edit_tool_username" placeholder="Username" required><br>
	<input type="text" name="edit_tool_password_key" id="edit_tool_password_key" placeholder="Password KEY" required>
	<input type="text" name="edit_tool_password" id="edit_tool_password" placeholder="Password" required>

	<div class="right-button">
		<input type="submit" name="edit_tool" id="edit_tool" class="submit" value="EDIT TOOL">
	</div>

</form>