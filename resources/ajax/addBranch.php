<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";

    if (isset($_POST['bra_name'])) {
        $bra_name = mysql_escape_mimic($_POST['bra_name']);
        $bra_cnt_id = mysql_escape_mimic($_POST['bra_cnt_id']);
        $bra_city = mysql_escape_mimic($_POST['bra_city']);
        $bra_add_srt = mysql_escape_mimic($_POST['bra_add_srt']);
        $bra_add_1 = mysql_escape_mimic($_POST['bra_add_1']);
        $bra_tel_1 = mysql_escape_mimic($_POST['bra_tel_1']);
        $bra_tel_2 = mysql_escape_mimic($_POST['bra_tel_2']);
        $bra_fax = mysql_escape_mimic($_POST['bra_fax']);
        $bra_email = mysql_escape_mimic($_POST['bra_email']);
        
        $result = array();
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->addBranch(array("bra_name"=> $bra_name, "bra_cnt_id"=> $bra_cnt_id,"bra_city"=>$bra_city, 
            "bra_add_srt"=>$bra_add_srt, "bra_add_1"=> $bra_add_1, "bra_tel_1"=>  $bra_tel_1,
            "bra_tel_2"=>$bra_tel_2, "bra_fax"=>$bra_fax, "bra_email"=>$bra_email));

        $result["msg"] = $response->return;
        echo(json_encode($result));        

        exit;
    }
    ?>