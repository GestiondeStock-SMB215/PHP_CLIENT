<?php
    date_default_timezone_set("Asia/Beirut");
    session_start();
    error_reporting(7);
    
    if(!isset($_SESSION["user"])){
        if($_SERVER['PHP_SELF'] != "/login.php"){
                header("location:/login.php");
        }
    }
    else{
        if($_SERVER['PHP_SELF'] == "/login.php"){
                header("location:/index.php");
        }
        if($_SESSION["user"]["user_role_id"] > $acl){
           header("location:/error.php");
        }
    }
 
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
        
    function checkTrackingIdValidation($trans_id){
        return $trans_id;
    }
    
    function log_toFile($array){
        $fp=fopen("log.txt", "a+");
        fwrite($fp, json_encode($array));
        fclose($fp);
    }
?>