<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
        
    if(isset($_GET["trans_det_id"])){
    $msg = "Are you sure you want to delete selected item?";
    if(isset($_GET["action"]) && $_GET["action"]=="delete"){
        deleteObj("TransDetail","trans_det_id",$_GET["trans_det_id"]);
        header("location:add.php?trans_id=".$_GET["trans_id"]);
    }
    }

?>
<div align="center">
    <h3><?=$msg?></h3>
    <input class="myButton" type="button" value="No" onclick="javascript:window.location.href='add.php?trans_id=<?=$_GET["trans_id"]?>'"/>
    &nbsp;&nbsp;&nbsp;
    <input class="myButton" type="button" value="Yes" onclick="javascript:window.location.href='deleteTransDetail.php?trans_det_id=<?=$_GET["trans_det_id"]?>&action=delete&trans_id=<?=$_GET["trans_id"]?>'" />
</div>