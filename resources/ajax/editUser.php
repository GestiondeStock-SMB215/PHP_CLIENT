<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";
    
    if (isset($_POST['user_name'])) {
        
        $user_name = mysql_escape_mimic($_POST['user_name']);
        $user_username = mysql_escape_mimic($_POST['user_username']);
        $user_password = mysql_escape_mimic($_POST['user_password']);
        $user_email = mysql_escape_mimic($_POST['user_email']);
        $result = array();
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->editUser(array("user_name"=>$user_name, 
            "user_username"=>$user_username, "user_password"=>  md5($user_password),
            "user_email"=>$user_email));            
        
        $result["msg"] = $response->return;
        echo(json_encode($result));
        exit;
    }