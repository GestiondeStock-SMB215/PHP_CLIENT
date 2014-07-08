<?php
	 include("../resources/lib.inc.php");
	if((isset($_POST["role_name"]))&&(isset($_POST["role_desc"]))&&(isset($_GET["role_id"]))){
		$dbconn = dbconnect();
		mysqli_query($dbconn,"UPDATE `role` SET `role_name` = '".$_POST["role_name"]."',`role_desc` = '".$_POST["role_desc"]."' WHERE `role_id` = '".$_GET["role_id"]."';");
		//die("UPDATE `role` SET `role_name` = '".$_POST["role_name"]."',`role_desc` = '".$_POST["role_desc"]."' WHERE `role_id` = '".$_GET["role_id"]."';");
                mysqli_close($dbconn);
	}
	header("location:role.php");
?>