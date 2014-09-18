<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";

if(isset($_GET["cust_id"])){
    $msg = "Are you sure you want to delete selected customer?";
    if(isset($_GET["action"]) && $_GET["action"]=="delete"){
         deleteObj("Customer", "cust_id", $_GET["cust_id"]);
        header("location:show.php");
    }
}
?>
<div align="center">
    <h3><?=$msg?></h3>
    <input class="myButton" type="button" value="No" onclick="javascript:window.location.href='show.php'" />
    &nbsp;&nbsp;&nbsp;
    <input class="myButton" type="button" value="Yes" onclick="javascript:window.location.href='delete.php?cust_id=<?=$_GET["cust_id"]?>&action=delete'" />
</div>