<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";
    
    if (isset($_POST['user_name'])) {
        
        $user_role_id = mysql_escape_mimic($_POST['user_role_id']);
        $user_name = mysql_escape_mimic($_POST['user_name']);
        $user_username = mysql_escape_mimic($_POST['user_username']);
        $user_password = mysql_escape_mimic($_POST['user_password']);
        $user_email = mysql_escape_mimic($_POST['user_email']);
        $user_status = mysql_escape_mimic($_POST['user_status']);
        $result = array();
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->addUser(array("user_role_id"=> $user_role_id,"user_name"=>$user_name, 
            "user_username"=>$user_username, "user_password"=>  md5($user_password),
            "user_email"=>$user_email, "user_status"=>$user_status));            
        
        $result["msg"] = $response->return;
        echo(json_encode($result));
        exit;
    }