<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";

if(isset($_GET["bra_id"])){
    $msg = "Are you sure you want to delete selected branch?";
    if(isset($_GET["action"]) && $_GET["action"]=="delete"){
        deleteBranch($_GET["bra_id"]);
        header("location:show.php");
    }
}
?>
<div align="center">
    <h3><?=$msg?></h3>
    <input class="myButton" value="No" onclick="javascript:window.location.href='show.php'" />
    &nbsp;&nbsp;&nbsp;
    <input class="myButton" value="Yes" onclick="javascript:window.location.href='delete.php?bra_id=<?=$_GET["bra_id"]?>&action=delete'" />
   
</div>