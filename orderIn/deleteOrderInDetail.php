<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
        
    if(isset($_GET["ord_in_det_id"])){
    $msg = "Are you sure you want to delete selected item?";
    if(isset($_GET["action"]) && $_GET["action"]=="delete"){
        deleteObj("OrderInDetail","ord_in_det_id",$_GET["ord_in_det_id"]);
        header("location:add.php?ord_in_id=".$_GET["ord_in_id"]);
    }
    }

?>
<div align="center">
    <h3><?=$msg?></h3>
    <input class="myButton" type="button" value="No" onclick="javascript:window.location.href='add.php?ord_in_id=<?=$_GET["ord_in_id"]?>'"/>
    &nbsp;&nbsp;&nbsp;
    <input class="myButton" type="button" value="Yes" onclick="javascript:window.location.href='deleteOrderInDetail.php?ord_in_det_id=<?=$_GET["ord_in_det_id"]?>&action=delete&ord_in_id=<?=$_GET["ord_in_id"]?>'" />
</div>