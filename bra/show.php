<?php
    $acl = 1;
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";


 function getBranches(){
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->getBranches();
        echo "<div class='registerContainer'><h1>BRANCHES</h1>";
        foreach($response as $item){
           
                echo "<div class='lbl'>";
                //echo "<div class='topMenu'>";
                echo "<div class='topMenu'>".$item->bra_name."</div>";
                echo "<div class='topMenu'>".$item->bra_city."</div>";
                echo $item->bra_tel_1;
                echo $item->bra_fax;
                echo $item->bra_email;
                echo "</div></div";
            }
       }
    
    getBranches();
?>
<style>