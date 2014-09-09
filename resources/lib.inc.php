<?php
    date_default_timezone_set("Asia/Beirut");
    session_start();
//    error_reporting(7);
    
//    if(isset($_SESSION["pages"])){
//        $pages = $_SESSION["pages"];
//        $curpage = $_SERVER["PHP_SELF"];
//        $result = false;
//        foreach($pages as $page){
//            if($page["page_url"] == $curpage){
//                $result = true;
//            }
//        }
//        if($result != true){
//            if(!stripos($_SERVER['PHP_SELF'], "resources/ajax")){ //IF NOT IN AJAX DIR                
//               header("location:/index.php");                
//            }            
//        }
//    }
//    
//    if(!isset($_SESSION["user"])){ //IF LOGOUT
//        if($_SERVER["PHP_SELF"] != "/login.php"){ //IF NOT IN LOGIN PAGE
//            if(!stripos($_SERVER['PHP_SELF'], "resources/ajax")){ //IF NOT IN AJAX DIR                
//                header("location:/login.php");                
//            }
//        }
//    }
//    else{
//        if($_SERVER['PHP_SELF'] == "/login.php"){
//            header("location:/index.php");
//        }
//    }

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
        $countries = array();
        set_time_limit(0);
        $response = $wsdl->getCountries();
        foreach($response->return as $country){
            array_push(
                $countries, 
                array(
                    "cnt_id" => $country->cnt_id,
                    "cnt_nicename" => $country->cnt_nicename
                )
            );
        }
        return $countries;
    }
    
    /* GET FROM DB */
    
    function getRoles(){
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->getRoles();
        
        $roles = array();
        foreach($response->return as $item){
            array_push(
                $roles,
                array(
                    "role_id" => $item->role_id,
                    "role_name" => $item->role_name,
                    "role_time_stamp" => $item->role_time_stamp
                )
            );
        }
        return $roles;
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
    function getAllPages(){
        global $wsdl;
        set_time_limit(0);
        $objs = array();
        $response = $wsdl->getPages();
        foreach($response->return as $item){
            array_push(
                $objs, 
                array(
                    "page_id"           => $item->page_id, 
                    "page_parent_id"    => $item->page_parent_id, 
                    "page_name"         => $item->page_name, 
                    "page_url"          => $item->page_url, 
                    "page_acl"          => $item->page_acl, 
                    "page_in_menu"      => $item->page_in_menu, 
                    "page_time_stamp"   => $item->page_time_stamp
                )
            );
        }
       
        return $objs;
    }
    function getAllUsers(){
        global $wsdl;
        set_time_limit(0);
        $objs = array();
        $response = $wsdl->getUsers();
        
        foreach($response as $return){
            foreach ($return as $item){
                array_push(
                    $objs, 
                    array(
                        "user_id"           => $item->user_id, 
                        "user_role_id"      => $item->user_role_id, 
                        "user_name"         => $item->user_name, 
                        "user_username"     => $item->user_username, 
                        "user_email"        => $item->user_email, 
                        "user_last_login"   => $item->user_last_login, 
                        "user_status"       => $item->user_status,
                        "user_time_stamp"   => $item->user_time_stamp
                    )
                );
            }
        }
       
        return $objs;
    }
    
    function getMenu($user_role_id){
        global $wsdl;
        set_time_limit(0);
        $pages = array();
        
        //GET ALL PERMITTED PAGES
        $response = $wsdl->getPages(array("user_role_id"=>$user_role_id));
        
        foreach($response as $return){
            foreach ($return as $item){
                array_push(
                    $pages, 
                    array(
                        "page_id" => $item->page_id, 
                        "page_parent_id" => $item->page_parent_id,
                        "page_name" => $item->page_name, 
                        "page_url" => $item->page_url, 
                        "page_in_menu" => $item->page_in_menu,
                        "page_order" => $item->page_order
                    )
                );
            }
        }
        $_SESSION["pages"] = $pages;
        
        foreach($pages as $page){
            if($page["page_parent_id"] == 0 && $page["page_in_menu"] == 1){
                echo "<div class=\"topMenu\">";
                    echo "<div class=\"title\">".$page["page_name"]."</div>";
                    echo "<div id=\"".$page["page_name"]."\" class=\"sub\">";
                    foreach($pages as $subpage){
                        if(($subpage["page_parent_id"] == $page["page_id"]) && ($subpage["page_in_menu"] == 1)){
                            echo "<a href=\"".$subpage["page_url"]."\"><div class=\"ttlSub\">".$subpage["page_name"]."</div></a>";     
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

    function deletePage($page_id){
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->deletePage(array("page_id"=>$page_id));                    
    }
    
    function getBranches($bra_id){
        global $wsdl;
        set_time_limit(0);
        $objs = array();
        if(isset($bra_id)){
            $response = $wsdl->getBranches($bra_id);
        }
        else{
            $response = $wsdl->getBranches();
        }
        foreach($response as $return){
            foreach ($return as $item){
                array_push(
                    $objs, 
                    array(
                        "bra_id"            => $item->bra_id, 
                        "bra_cnt_id"        => $item->bra_cnt_id, 
                        "bra_name"          => $item->bra_name, 
                        "bra_city"          => $item->bra_city, 
                        "bra_add_str"       => $item->bra_add_str, 
                        "bra_add_1"         => $item->bra_add_1, 
                        "bra_tel_1"         => $item->bra_tel_1,
                        "bra_tel_2"         => $item->bra_tel_2,
                        "bra_fax"           => $item->bra_fax,
                        "bra_email"         => $item->bra_email,
                        "bra_time_stamp"    => $item->bra_time_stamp
                    )
                );
            }
        }
       
        return $objs;
    }
    
    function getRoleName($role_id){
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->getRoleName(array("role_id" => $role_id));
        return $response->return;
    }
?>
