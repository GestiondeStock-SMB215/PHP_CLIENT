<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";
    
    if (isset($_POST['user_username'])) {
        
        $user_username = mysql_escape_mimic($_POST['user_username']);

        $result = array();
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->checkUserNameValidity(array("user_username"=>$user_username));            
        
        if($response->return == true){
            $result["err"] = "0";
            $result["msg"] = "Username accepted";
        }
        else{
            $result["err"] = "1";
            $result["msg"] = "Username already exists";
        }
        echo(json_encode($result));
        exit;
    }