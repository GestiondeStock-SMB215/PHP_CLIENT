<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";

if(isset($_GET["cat_id"])){
    $msg = "Are you sure you want to delete selected category?";
    if(isset($_GET["action"]) && $_GET["action"]=="delete"){
        deleteObj("Category", "cat_id", $_GET["cat_id"]);
        header("location:show.php");
    }
}
?>
<div align="center">
    <h3><?=$msg?></h3>
    <input class="myButton" value="No" onclick="javascript:window.location.href='show.php'" />
    &nbsp;&nbsp;&nbsp;
    <input class="myButton" value="Yes" onclick="javascript:window.location.href='delete.php?cat_id=<?=$_GET["cat_id"]?>&action=delete'" />
</div>
