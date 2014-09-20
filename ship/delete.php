<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";

if(isset($_GET["ship_id"])){
    $msg = "Are you sure you want to delete selected shipper?";
    if(isset($_GET["action"]) && $_GET["action"]=="delete"){
        deleteObj("Shipper", "ship_id", $_GET["ship_id"]);
        header("location:show.php");
    }
}
?>
<div align="center">
    <h3><?=$msg?></h3>
    <input class="myButton" type="button" value="No" onclick="javascript:window.location.href='show.php'" />
    &nbsp;&nbsp;&nbsp;
    <input class="myButton" type="button" value="Yes" onclick="javascript:window.location.href='delete.php?ship_id=<?=$_GET["ship_id"]?>&action=delete'" />
   
</div>
