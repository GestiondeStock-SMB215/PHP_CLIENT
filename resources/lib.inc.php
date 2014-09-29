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
    
    function logToFile($txt){
        $fp=fopen("log.txt", "a+");
        fwrite($fp, getDT()." - ".json_encode($txt)."\n");
        fclose($fp);
    }
    
    function printR($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
    
    function readObj($obj_type, $obj_id_field, $obj_id){
        global $wsdl;
        set_time_limit(0);
        
        $objs       = array();
        $func       = "read".$obj_type;
        $response = $wsdl->$func(array($obj_id_field => $obj_id));
        if(gettype($response->return) == "array"){
            foreach ($response->return as $obj){
                $obj = get_object_vars($obj);
                array_push($objs,$obj);
            }
        }
        else{
            if(gettype($response->return) == "object"){
                array_push($objs,get_object_vars($response->return));
            }
        }
        return $objs;
    }
    
    function deleteObj($obj_type, $obj_id_field, $obj_id){
        global $wsdl;
        set_time_limit(0);
        
        $objs       = array();
        $func       = "delete".$obj_type;
        $response = $wsdl->$func(array($obj_id_field => $obj_id));
        return $response->return;
    }
    
    function aeObj($obj_type, $array){
        global $wsdl;
        set_time_limit(0);
        $func = "ae".$obj_type;
        return $wsdl->$func($array)->return;
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
                            echo "<div class=\"ttlSub\"><a href=\"".$subpage["page_url"]."\">".$subpage["page_name"]."</a></div>";     
                        }
                    }
                echo "</div>";
                echo "</div>";
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
    
    function getNextId($tableName, $idName){
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->getNextId(array("tableName"=>$tableName, "idName"=> $idName));        
        return $response->return;
    }