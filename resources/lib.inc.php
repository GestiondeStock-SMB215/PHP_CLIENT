<?php
    date_default_timezone_set("Asia/Beirut");
    session_start();
    error_reporting(7);
    
    if(isset($_SESSION["pages"])){
        $pages = $_SESSION["pages"];
        $curpage = $_SERVER["PHP_SELF"];
        $result = false;
        foreach($pages as $page){
            if($page["page_url"] == $curpage){
                $result = true;
            }
        }
        if($result != true){
            if(!stripos($_SERVER['PHP_SELF'], "resources/ajax")){ //IF NOT IN AJAX DIR                
                header("location:/index.php");                
            }            
        }
    }
    
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
        
        foreach($response as $return){
            foreach ($return as $item){
                echo "<option value=\"".$item->user_id."\">".$item->user_name."</option>";
            }
        }
    }
    function getCountries(){
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->getCountries();
        
        foreach($response as $return){
            foreach ($return as $item){
                echo "<option value=\"".$item->cnt_id."\">".$item->cnt_nicename."</option>";
            }
        }
    }
    
    /* GET FROM DB */
    
    function getRoles(){
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->getRoles();
        
        foreach($response as $return){
            foreach ($return as $item){
                echo "<option value=\"".$item->role_id."\">".$item->role_name."</option>";
           }
       }
    }
    
    function getPages($user_role_id){
        global $wsdl;
        set_time_limit(0);
        $pages = array();
        $response = $wsdl->getPages(array("user_role_id"=>$user_role_id));
        foreach($response as $return){
            foreach ($return as $item){
                array_push($pages, array("page_id" => $item->page_id, "page_parent_id" => $item->page_parent_id, 
                    "page_name" => $item->page_name, "page_url" => $item->page_url));
            }
        }
        $_SESSION["pages"] = $pages;
    }
    
    function getMenu($user_role_id){
        //$pages = $_SESSION["pages"] ;
        
        //TO BE DELETED ON PRODUCTION        
        global $wsdl;
        set_time_limit(0);
        $pages = array();
        $response = $wsdl->getPages(array("user_role_id"=>$user_role_id));
        foreach($response as $return){
            foreach ($return as $item){
                array_push($pages, array("page_id" => $item->page_id, "page_parent_id" => $item->page_parent_id, 
                    "page_name" => $item->page_name, "page_url" => $item->page_url, "page_in_menu" => $item->page_in_menu));
            }
        }
        $_SESSION["pages"] = $pages;
        //TO BE DELETED ON PRODUCTION
        
        for($i = 0; $i < sizeof($pages); $i++){
            if($pages[$i]["page_parent_id"] == 0 && $pages[$i]["page_in_menu"] == 1){
                echo "<div class=\"topMenu\">";
                echo "<div class=\"title\">".$pages[$i]["page_name"]."</div>";
                echo "<div id=\"".$pages[$i]["page_name"]."\" class=\"sub\">";
                for($j = 0; $j < sizeof($pages); $j++){
                    if($pages[$j]["page_parent_id"] == $pages[$i]["page_id"] && $pages[$i]["page_in_menu"] == 1){
                        echo "<a href=\"".$pages[$j]["page_url"]."\"><div class=\"ttlSub\">".$pages[$j]["page_name"]."</div></a>";
                    }
                }
                echo "</div></div>";
            }
        }
    }
    
    function getRootPages(){
        $pages = $_SESSION["pages"];
        foreach($pages as $page){
            if($page["page_parent_id"] == 0){
                echo "<option value=\"".$page["page_id"]."\">".$page["page_name"]."</option>";
            }
        }
    }

    function createPageDirectory($page_url){
        $arr = explode("/", $page_url);
        
        $pageDir = $_SERVER['DOCUMENT_ROOT']."/".$arr[1]."/";
        
        if(!file_exists($pageDir) OR !is_dir($pageDir)){
            mkdir($pageDir);         
        }
        if(!file_exists($pageDir."/".$arr[2])){
            $pageFile = fopen($pageDir."/".$arr[2], 'w') or die("unable to create file");
            $txt = "<?php\n";
            $txt .= "require_once ";
            $txt .= "$";$txt .= "_";$txt .= "SERVER[\"DOCUMENT_ROOT\"].\"/resources/header.inc.php\";";
            fwrite($pageFile, $txt);
            fclose($pageFile);        
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