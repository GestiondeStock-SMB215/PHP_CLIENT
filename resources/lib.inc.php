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
    function getUsers(){
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->getUsers();
        print_r($response);
        foreach($response as $return){
            foreach($return as $item){
            echo "<option value=\"".$item->user_id."\>".$item->user_name."</option>";
        }
      }
    }
    function addProduct($prod_id,$prod_cat_id,$prod_sku,$prod_upc,$prod_name,$prod_desc,
                        $prod_qty,$prod_qty_per_unit,$prod_color,$prod_size,$prod_weight,
                        $prod_sup_id,$prod_status,$prod_pic,$prod_vend_id){
        global $wsdl;
        set_time_limit(0);
        $query=  addProduct($prod_id, $prod_cat_id, $prod_sku, $prod_upc, $prod_name, $prod_desc,
                $prod_qty, $prod_qty_per_unit, $prod_color, $prod_size, $prod_weight, $prod_sup_id,
                $prod_status, $prod_pic, $prod_vend_id);
    }
    function getCountries(){
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->getCountries();
        print_r($response);
        foreach($response as $return){
            foreach($return as $item){
            echo "<option value=\"".$item->bra_id."\>".$item->bra_name."</option>";
        }
      }
    }
    
    /* GET FROM DB */
    
    function getRoles(){
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->getRoles();
        print_r($response);
        foreach($response as $return){
            foreach ($return as $item){
                echo "<option value=\"".$item->role_id."\">".$item->role_name."</option>";
           }
       }
    }
    
    function checkUserNameValidity($user_username){
        $user_username = mysql_escape_mimic($user_username);
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
        return(json_encode($result));
    }
        
    function checkUserEmailValidity($user_email){
        $user_email = mysql_escape_mimic($user_email);
        $result = array();
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->checkUserEmailValidity(array("user_email"=>$user_email));            
        logToFile($response);
        if($response->return == true){
            $result["err"] = "0";
            $result["msg"] = "Email accepted";
        }
        else{
            $result["err"] = "1";
            $result["msg"] = "Email already exists";
        }
        return(json_encode($result));
    }
?>