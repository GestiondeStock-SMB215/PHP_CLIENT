<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";

if(isset($_GET["bra_id"])){
    $msg = "Are you sure you want to delete selected branch?";
    if(isset($_GET["action"]) && $_GET["action"]=="delete"){
        deleteBranch($bra_id);
        header("location:show.php");
    }
}
?>
<div align="center">
    <h3><?=$msg?></h3>
    <input class="myButton" value="No" onclick="javasctipt:window.location.href='show.php'" />
    &nbsp;&nbsp;&nbsp;
    <input class="myButton" value="Yes" onclick="javasctipt:window.location.href='delete.php?bra_id=<?=$bra_id?>&action=delete'" />
   
</div>