<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";

    if (isset($_POST['cust_comp'])) {
        $cust_comp = mysql_escape_mimic($_POST['cust_comp']);
        $cust_name = mysql_escape_mimic($_POST['cust_name']);
        $cust_title = mysql_escape_mimic($_POST['cust_title']);
        $cust_add_1 = mysql_escape_mimic($_POST['cust_add_1']);
        $cust_add_2 = mysql_escape_mimic($_POST['cust_add_2']);
        $cust_city = mysql_escape_mimic($_POST['cust_city']);
        $cust_cnt_id = mysql_escape_mimic($_POST['cust_cnt_id']);
        $cust_tel_1 = mysql_escape_mimic($_POST['cust_tel_1']);
        $cust_tel_2 = mysql_escape_mimic($_POST['cust_tel_2']);
        $cust_fax = mysql_escape_mimic($_POST['cust_fax']);
        $cust_email = mysql_escape_mimic($_POST['cust_email']);
        $cust_site = mysql_escape_mimic($_POST['cust_site']);
        $cust_logo = mysql_escape_mimic($_POST['cust_logo']);
        
        $result = array();
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->addCustomer(array("cust_comp"=>$cust_comp, "cust_name"=>$cust_name,"cust_title"=>$cust_title, 
            "cust_add_1"=>$cust_add_1, "cust_add_2"=>$cust_add_2, "cust_city"=>$cust_city,
            "cust_cnt_id"=>$cust_cnt_id, "cust_tel_1"=>$cust_tel_1, "cust_tel_2"=>$cust_tel_2,
            "cust_fax"=>$cust_fax, "cust_email"=>$cust_email, "cust_site"=>$cust_site, "cust_logo"=>$cust_logo));

        $result["msg"] = $response->return;
        echo(json_encode($result));        

        exit;
    }
    ?>
