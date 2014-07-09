<?php
    date_default_timezone_set("Asia/Beirut");
    session_start();
    error_reporting(7);
    
    //Security for webservices
    $configFile = json_decode(file_get_contents('C:\\config\\config.json'),true);
    $jaxwsSecAppId = $configFile["jaxwsSec"]["appId"];
    $jaxwsSecUsername = $configFile["jaxwsSec"]["username"];
    $jaxwsSecPassword = $configFile["jaxwsSec"]["password"];
    
    //WSDL FILE
    $wsdl =  new SoapClient('http://localhost:8080/JAX_WS/JAX_WS?WSDL');
    
    function getDT(){
        return date("Y-m-d H:i:s");
    }
    
    function getD(){
        return date("Y-m-d");
    }
    
    function mysql_escape_mimic($inp) { 
        if(is_array($inp)) 
            return array_map(__METHOD__, $inp); 

        if(!empty($inp) && is_string($inp)) { 
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
        } 

        return $inp; 
    }   
    
    function login($username, $password){
        $user_username = mysql_escape_mimic($username);
        $user_password = MD5(mysql_escape_mimic($password));
        
        //Result array to be encodd into json
        $res = null;
       
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->getUserByUsername(array("user_username"=>$user_username, "user_password"=>$user_password));
        foreach ($response as $item){
            if($item->userId == ''){
                $res["err"] = "1";
                $res["msg"] = "Nom d'usager ou mot de passe sont incorrectes";
            }
            else{
                //Inactive
                if($item->userStatus == 2){
                    $res["err"] = "2";
                    $res["msg"] = "Votre compte est bloqué.";
                }
                else{
                    $res["err"] = "0";
                    $res["msg"] = "Login successfull";
                    $user = null;
                    $user["userId"] = $item->userId;
                    $user["userName"] = $item->userName;
                    $user["userUsername"] = $item->userUsername;
                    //$user["userPassword"] = $item->userPassword;
                    $user["userEmail"] = $item->userEmail;
                    $user["userLastLogin"] = $item->userLastLogin;
                    $user["userRoleId"] = $item->userRoleId;
                    $user["userStatus"] = $item->userStatus;
                    $user["userTimeStamp"] = $item->userTimeStamp;
                    $res["user"] = $user;
                    $res = json_encode($res);
                }
            }
        }
        return $res;
    }    
    
    function checkTrackingIdValidation($trans_id){
        return true;
    }
?>