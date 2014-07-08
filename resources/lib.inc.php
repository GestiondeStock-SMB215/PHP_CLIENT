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
        
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->getUserByUsername(array("user_username"=>$user_username, "user_password"=>$user_password));
        
        foreach ($response as $item){
            if($item->userId == null){
                return "Nom d'usager ou mot de passe sont incorrectes";
            }
            else{
                //Inactive
                if($item->userStatus == 2){
                    echo "Votre compte est bloqué.";
                }
                else{
                    echo "ID: ".$item->userId."<br>";
                    echo "Name: ".$item->userName."<br>";
                    echo "Username: ".$item->userUsername."<br>";
                    echo "Password: ".$item->userPassword."<br>";
                    echo "Email: ".$item->userEmail."<br>";
                    echo "Last Login: ".$item->userLastLogin."<br>";
                    echo "Role: ".$item->userRoleId."<br>";
                    echo "Status: ".$item->userStatus."<br>";
                    echo "Time Stamp: ".$item->userTimeStamp."<br>";
                }
            }
        }
    }    
    
    function checkTrackingIdValidation($trans_id){
        return true;
    }
?>