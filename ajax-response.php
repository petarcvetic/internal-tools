<?php
include "dbconfig.php";

/*EDIT CONTACT*/
if(isset($_POST["edit_table"]) and $_POST["edit_table"] == 1){
	$tbl_name = strip_tags($_POST["table"]);
	$id = strip_tags($_POST["id"]);
	
	if ($tbl_name == "tools") {
		$row = $getData->get_tool_by_id($id);
		$teams = $row['teams'];
		$teams_array = explode(",",$teams);

		foreach ($teams_array as $team) {
			echo "<script>aler('".$team."');</script>";
			if($team=="SEO"){
				echo "<script>$('#edit_seo_team').prop('checked', true);</script>";
			}

			if($team=="SOCIAL"){
				echo "<script>$('#edit_social_team').prop('checked', true);</script>";
			}

			if($team=="DEV"){
				echo "<script>$('#edit_dev_team').prop('checked', true);</script>";
			}

			if($team=="LINK"){
				echo "<script>$('#edit_linkbuilding_team').prop('checked', true);</script>";
			}

			if($team=="CONTENT"){
				echo "<script>$('#edit_content_team').prop('checked', true);</script>";
			}

			if($team=="IT"){
				echo "<script>$('#edit_it_team').attr('checked', true);</script>";
			}

			if($team=="PM"){
				echo "<script>$('#edit_pm_team').prop('checked', true);</script>";
			}
		}

	}

	echo '<script>
			$("#edit_tool_id").val("'.$row["tool_id"].'");
			$("#edit_tool_name").val("'.$row["tool_name"].'");
			$("#edit_tool_url").val("'.$row["tool_url"].'");
			$("#edit_tool_username_key").val("'.$row["tool_username_key"].'");
			$("#edit_tool_username").val("'.$row["tool_username"].'");
			$("#edit_tool_password_key").val("'.$row["tool_password_key"].'");
			$("#edit_tool_password").val("'.$row["tool_password"].'");
		</script>';
}
/*END edit contact*/

?>