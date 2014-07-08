<?php
	include("../resources/lib.inc.php");
	if((isset($_GET["role_id"]))){
		$dbconn = dbconnect();
		mysqli_query($dbconn,"DELETE FROM `role` WHERE `role_id` = '".$_GET["role_id"]."'");
                
               // die("DELETE FROM `role` WHERE `role_id` = '".$_GET["role_id"]."'");
		mysqli_close($dbconn);
	}
	header("location:role.php");
?>