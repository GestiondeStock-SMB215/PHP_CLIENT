<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
        
    if(isset($_GET["ord_out_det_id"])){
    $msg = "Are you sure you want to delete selected item?";
    if(isset($_GET["action"]) && $_GET["action"]=="delete"){
        deleteObj("OrderOutDetail","ord_out_det_id",$_GET["ord_out_det_id"]);
        header("location:add.php?ord_out_id=".$_GET["ord_out_id"]);
    }
    }

?>
<div align="center">
    <h3><?=$msg?></h3>
    <input class="myButton" type="button" value="No" onclick="javascript:window.location.href='add.php?ord_out_id=<?=$_GET["ord_out_id"]?>'"/>
    &nbsp;&nbsp;&nbsp;
    <input class="myButton" type="button" value="Yes" onclick="javascript:window.location.href='deleteOrderOutDetail.php?ord_out_det_id=<?=$_GET["ord_out_det_id"]?>&action=delete&ord_out_id=<?=$_GET["ord_out_id"]?>'" />
</div>