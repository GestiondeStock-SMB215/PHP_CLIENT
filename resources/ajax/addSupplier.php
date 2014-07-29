<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";

    if (isset($_POST['sup_comp'])) {
        $sup_comp = mysql_escape_mimic($_POST['sup_comp']);
        $sup_name = mysql_escape_mimic($_POST['sup_name']);
        $sup_title = mysql_escape_mimic($_POST['sup_title']);
        $sup_add_1 = mysql_escape_mimic($_POST['sup_add_1']);
        $sup_add_2 = mysql_escape_mimic($_POST['sup_add_2']);
        $sup_city = mysql_escape_mimic($_POST['sup_city']);
        $sup_cnt_id = mysql_escape_mimic($_POST['sup_cnt_id']);
        $sup_tel_1 = mysql_escape_mimic($_POST['sup_tel_1']);
        $sup_tel_2 = mysql_escape_mimic($_POST['sup_tel_2']);
        $sup_fax = mysql_escape_mimic($_POST['sup_fax']);
        $sup_email = mysql_escape_mimic($_POST['sup_email']);
        $sup_site = mysql_escape_mimic($_POST['sup_site']);
        $sup_logo = mysql_escape_mimic($_POST['sup_logo']);
        
        $result = array();
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->addSupplier(array("sup_comp"=>$sup_comp,"sup_name"=>$sup_name,"sup_title"=>$sup_title, 
            "sup_add_1"=>$sup_add_1,"sup_add_2"=>$sup_add_2,"sup_city"=>$sup_city,
            "sup_cnt_id"=>$sup_cnt_id,"sup_tel_1"=>$sup_tel_1,"sup_tel_2"=>$sup_tel_2,
            "sup_fax"=>$sup_fax,"sup_email"=>$sup_email,"sup_site"=>$sup_site,"sup_logo"=>$sup_logo));

        $result["msg"] = $response->return;
        echo(json_encode($result));        

        exit;
    }
    ?>
