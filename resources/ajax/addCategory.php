<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";

    if (isset($_POST['cat_name'])) {
        $cat_name = mysql_escape_mimic($_POST['cat_name']);
        $cat_desc = mysql_escape_mimic($_POST['cat_desc']);
        $cat_pic = mysql_escape_mimic($_POST['cat_pic']);
        
        $result = array();
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->addCategory(array("cat_name"=>$cat_name,"cat_desc"=>$cat_desc,"cat_pic"=>$cat_pic));

        $result["msg"] = $response->return;
        echo(json_encode($result));        

        exit;
    }
    ?>