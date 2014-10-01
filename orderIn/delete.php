<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";

    
    if(isset($_GET["ord_in_id"])){
    $msg = "Are you sure you want to delete selected order?";
    if(isset($_GET["action"]) && $_GET["action"]=="delete"){
        $detail= readObj("OrderInDetail", "ord_in_det_id", "-1");
        foreach($detail as $d){
            if($d["ord_in_det_ord_in_id"]==$_GET["ord_in_id"]){
                logToFile($d["ord_in_det_ord_in_id"]);
                deleteObj("OrderInDetail", "ord_in_det_ord_in_id",$_GET["ord_in_id"]);
            }
        }
         deleteObj("OrderIn", "ord_in_id", $_GET["ord_in_id"]);
         
        header("location:show.php");
    }
    }

?>
<div align="center">
    <h3><?=$msg?></h3>
    <input class="myButton" type="button" value="No" onclick="javascript:window.location.href='show.php'" />
    &nbsp;&nbsp;&nbsp;
    <input class="myButton" type="button" value="Yes" onclick="javascript:window.location.href='delete.php?ord_in_id=<?=$_GET["ord_in_id"]?>&action=delete'" />
</div>