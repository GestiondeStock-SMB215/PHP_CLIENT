<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";

if(isset($_GET["sup_id"])){
    $msg = "Are you sure you want to delete selected supplier?";
    if(isset($_GET["action"]) && $_GET["action"]=="delete"){
        deleteSupplier($_GET["sup_id"]);
        header("location:show.php");
    }
}
?>
<div align="center">
    <h3><?=$msg?></h3>
    <input class="myButton" value="No" onclick="javascript:window.location.href='show.php'" />
    &nbsp;&nbsp;&nbsp;
    <input class="myButton" value="Yes" onclick="javascript:window.location.href='delete.php?sup_id=<?=$_GET["sup_id"]?>&action=delete'" />
</div>