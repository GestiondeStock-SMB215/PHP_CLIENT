<?php
    date_default_timezone_set("Asia/Beirut");
    session_start();
//    error_reporting(7);
    
    //SECURITY//
    $curPage = explode("/", $_SERVER["PHP_SELF"])[1];
    
    if($curPage == "login.php"){
        if(isset($_SESSION["user"])){
            //header("location:index.php");
        }
    }
    else{
        if($curPage != "resources"){
            if(!isset($_SESSION["user"])){
                //header("location:login.php");
            }
            else{
                if(!in_array($_SERVER["PHP_SELF"], $_SESSION["pages"])){
                    //header("location:/index.php");
                }
            }
        }
    }
    //SECURITY//

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
        $fullPages = array();
        $response = $wsdl->getPages(array("user_role_id"=>$user_role_id));
        foreach($response as $return){
            foreach ($return as $item){
                array_push(
                    $fullPages, 
                    array(
                        "page_id" => $item->page_id, 
                        "page_parent_id" => $item->page_parent_id, 
                        "page_name" => $item->page_name, 
                        "page_in_menu"=>$item->page_in_menu, 
                        "page_url" => $item->page_url
                    )
                );
                array_push($pages, $item->page_url);
            }
        }
        $_SESSION["pages"]      = $pages;
        $_SESSION["fullPages"]  = $fullPages;
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
        
        $fullPages = $_SESSION["fullPages"];
        
        foreach($fullPages as $page){
            if($page["page_parent_id"] == 0 && $page["page_in_menu"] == 1){
                echo "<div class=\"topMenu\">";
                    echo "<div class=\"title\">".$page["page_name"]."</div>";
                    echo "<div id=\"".$page["page_name"]."\" class=\"sub\">";
                    foreach($fullPages as $subpage){
                        if(($subpage["page_parent_id"] == $page["page_id"]) && ($subpage["page_in_menu"] == 1)){
                            echo "<a href=\"".$subpage["page_url"]."\"><div class=\"ttlSub\">".$subpage["page_name"]."</div></a>";     
                        }
                    }
                echo "</div></div>";
            }
        }
    }
    
    function getRootPages(){
        $fullPages = $_SESSION["fullPages"];
        foreach($fullPages as $page1){
            $found = false;
            foreach($fullPages as $page2){
                if($page1["page_id"] == $page2["page_parent_id"] || (explode("/", $page1["page_url"])[2] == "show.php")){
                    $found = true;
                }
            }
            if($found){
                echo "<option value=\"".$page1["page_id"]."\">".$page1["page_name"]."</option>";
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
            $txt .= "$";$txt .= "_";$txt .= "SERVER[\"DOCUMENT_ROOT\"].\"/resources/header.inc.php\";\n";
            $txt .= "?>\n";
            $txt .= "<?php\n";
            $txt .= "require_once ";
            $txt .= "$";$txt .= "_";$txt .= "SERVER[\"DOCUMENT_ROOT\"].\"/resources/footer.inc.php\";\n";
            $txt .= "?>\n";
            fwrite($pageFile, $txt);
            fclose($pageFile);        
        }        

    }

    function deletePage($page_id){
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->deletePage(array("page_id"=>$page_id));                    
    }
    
    function deleteBranch($bra_id){
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->deleteBranch(array("bra_id"=>$bra_id));        
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
    
    function getCategories(){
        global $wsdl;
        $objs = array();
        set_time_limit(0);
        $response = $wsdl->getCategories();
        foreach($response->return as $obj){
            array_push(
                $objs, 
                array(
                    "cat_id"        => $obj->cat_id,
                    "cat_name"      => $obj->cat_name,
                    "cat_desc"      => $obj->cat_desc,
                    "cat_pic"       => $obj->cat_pic,
                    "cat_time_stamp"=> $obj->cat_time_stamp
                )
            );
        }
        return $objs;
    }

    function getProducts(){
        global $wsdl;
        $objs = array();
        set_time_limit(0);
        $response = $wsdl->getProducts();
        foreach($response->return as $obj){
            array_push(
                $objs, 
                array(
                    "prod_id"           => $obj->prod_id,
                    "prod_cat_id"       => $obj->prod_cat_id,
                    "prod_sku"          => $obj->prod_sku,
                    "prod_upc"          => $obj->prod_upc,
                    "prod_name"         => $obj->prod_name,
                    "prod_desc"         => $obj->prod_desc,
                    "prod_qty"          => $obj->prod_qty,
                    "prod_qty_per_unit" => $obj->prod_qty_per_unit,
                    "prod_color"        => $obj->prod_color,
                    "prod_size"         => $obj->prod_size,
                    "prod_time_stamp"   => $obj->prod_time_stamp
                )
            );
        }
        return $objs;
    }
    function getCustomers($cust_id){
        global $wsdl;
        set_time_limit(0);
        $objs = array();
        if(isset($bra_id)){
            $response = $wsdl->getCustomers($cust_id);
        }
        else{
            $response = $wsdl->getCustomers();
        }
        foreach($response as $return){
            foreach ($return as $item){
                array_push(
                    $objs, 
                    array(
                        "cust_id"            => $item->cust_id, 
                        "cust_comp"          => $item->cust_comp, 
                        "cust_name"          => $item->cust_name, 
                        "cust_title"         => $item->cust_title, 
                        "cust_add_1"         => $item->cust_add_1, 
                        "cust_add_2"         => $item->cust_add_2, 
                        "cust_city"          => $item->cust_city,
                        "cust_cnt_id"        => $item->cust_cnt_id,
                        "cust_tel_1"         => $item->cust_tel_1,
                        "cust_tel_2"         => $item->cust_tel_2,
                        "cust_fax"           => $item->cust_fax,
                        "cust_email"         => $item->cust_email,
                        "cust_site"          => $item->cust_site,
                        "cust_logo"          => $item->cust_logo,
                        "cust_time_stamp"    => $item->cust_time_stamp
                    )
                );
            }
        }
       
        return $objs;
    }
    function getSuppliers($sup_id){
        global $wsdl;
        set_time_limit(0);
        $objs = array();
        if(isset($sup_id)){
            $response = $wsdl->getSuppliers($sup_id);
        }
        else{
            $response = $wsdl->getSuppliers();
        }
        foreach($response as $return){
            foreach ($return as $item){
                array_push(
                    $objs, 
                    array(
                        "sup_id"            => $item->sup_id, 
                        "sup_comp"          => $item->sup_comp, 
                        "sup_name"          => $item->sup_name, 
                        "sup_title"         => $item->sup_title, 
                        "sup_add_1"         => $item->sup_add_1, 
                        "sup_add_2"         => $item->sup_add_2, 
                        "sup_city"          => $item->sup_city,
                        "sup_cnt_id"        => $item->sup_cnt_id,
                        "sup_tel_1"         => $item->sup_tel_1,
                        "sup_tel_2"         => $item->sup_tel_2,
                        "sup_fax"           => $item->sup_fax,
                        "sup_email"         => $item->sup_email,
                        "sup_site"          => $item->sup_site,
                        "sup_logo"          => $item->sup_logo,
                        "sup_time_stamp"    => $item->sup_time_stamp
                    )
                );
            }
        }
       
        return $objs;
    }
    
?>