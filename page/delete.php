<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";

if(isset($_GET["page_id"])){
    $page_id = $_GET["page_id"];
    $msg = "Are you sure you want to delete selected page?";
    if(isset($_GET["action"]) && $_GET["action"]=="delete"){
        deleteObj("Page", "page_id", $page_id);
        header("location:show.php");
    }
}
?>
<div align="center">
    <h3><?=$msg?></h3>
    <input class="myButton" value="No" onclick="javasctipt:window.location.href='show.php'" />
    &nbsp;&nbsp;&nbsp;
    <input class="myButton" value="Yes" onclick="javasctipt:window.location.href='delete.php?page_id=<?=$page_id?>&action=delete'" />
</div>