<?php
    date_default_timezone_set("Asia/Beirut");
    session_start();
    error_reporting(7);
    
    if(!isset($_SESSION["user"])){ //IF LOGOUT
        if($_SERVER["PHP_SELF"] != "/login.php"){ //IF NOT IN LOGIN PAGE
            if(!stripos($_SERVER['PHP_SELF'], "resources/ajax")){ //IF NOT IN AJAX DIR                
                header("location:/login.php");                
            }
        }
    }
    else{
        if($_SERVER['PHP_SELF'] == "/login.php"){
            header("location:/index.php");
        }
    }
    
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
    
    function logToFile($array){
        $fp=fopen("log.txt", "a+");
        fwrite($fp, getDT()." - ".json_encode($array)."\n");
        fclose($fp);
    }
?>