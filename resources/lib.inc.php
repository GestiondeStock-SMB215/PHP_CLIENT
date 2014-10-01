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
    
    function  readObj($obj_type, $obj_id_field, $obj_id){
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
    
    function getOrderOutDetailByOrdOutId($ord_out_det_ord_out_id){
        global $wsdl;
        $objs = array();
        set_time_limit(0);
        $response = $wsdl->getOrderOutDetailByOrdOutId(array("ord_out_det_ord_out_id"=>$ord_out_det_ord_out_id));
        if(gettype($response->return) == "array"){
            foreach ($response->return as $obj){
                $obj = get_object_vars($obj);
                array_push($objs,$obj);
            }
        }
        else{
            if(gettype($response->return) == "object"){
                if($response->return->ord_out_det_id != "-1"){
                    array_push($objs,get_object_vars($response->return));
                }
                
            }
        }
        return $objs;
    }
    function getOrderInDetailByOrdInId($ord_in_det_ord_in_id){
        global $wsdl;
        $objs = array();
        set_time_limit(0);
        $response = $wsdl->getOrderInDetailByOrdInId(array("ord_in_det_ord_in_id"=>$ord_in_det_ord_in_id));
        if(gettype($response->return) == "array"){
            foreach ($response->return as $obj){
                $obj = get_object_vars($obj);
                array_push($objs,$obj);
            }
        }
        else{
            if(gettype($response->return) == "object"){
                if($response->return->ord_in_det_id != "-1"){
                    array_push($objs,get_object_vars($response->return));
                }
                
            }
        }
        return $objs;
    }
    function getSupSession(){
    if(!isset($_SESSION["suppliers"])){
    $suppliers = array();
    $objs = readObj("Supplier", "sup_id", "-1");
    foreach($objs as $obj){
        array_push(
                $suppliers,
                array(
                    "sup_id"=>$obj["sup_id"],
                    "sup_comp"=>$obj["sup_comp"],
                    "sup_name"=>$obj["sup_name"],
                    "sup_title"=>$obj["sup_title"],
                    "sup_add_1"=>$obj["sup_add_1"],
                    "sup_add_2"=>$obj["sup_add_2"],
                    "sup_city"=>$obj["sup_city"],
                    "sup_cnt_id"=>$obj["sup_cnt_id"],
                    "sup_tel_1"=>$obj["sup_tel_1"],
                    "sup_tel_2"=>$obj["sup_tel_2"],
                    "sup_fax"=>$obj["sup_fax"],
                    "sup_email"=>$obj["sup_email"],
                    "sup_site"=>$obj["sup_site"],
                    "sup_time_stamp"=>$obj["sup_time_stamp"]
                    
                ));
    }
    $_SESSION["suppliers"] = $suppliers;
}
    }
    function getProdSession(){
if(!isset($_SESSION["products"])){
    $products = array();
    $objs = readObj("Product", "prod_id", "-1");
    foreach($objs as $obj){
        array_push(
                $products, 
                array(
                    "prod_id"=>$obj["prod_id"],
                    "prod_cat_id"=>$obj["prod_cat_id"],
                    "prod_sku"=>$obj["prod_sku"],
                    "prod_upc"=>$obj["prod_upc"],
                    "prod_name"=>$obj["prod_name"],
                    "prod_desc"=>$obj["prod_desc"],
                    "prod_qty"=>$obj["prod_qty"],
                    "prod_color"=>$obj["prod_color"],
                    "prod_size"=>$obj["prod_size"],
                    "prod_weight"=>$obj["prod_weight"],
                    "prod_sup_id"=>$obj["prod_sup_id"],
                    "prod_up"=>$obj["prod_up"],
                    "prod_status"=>$obj["prod_status"],
                    "prod_vend_id"=>$obj["prod_vend_id"],
                    "prod_time_stamp"=>$obj["prod_time_stamp"]
                    ));
    }
    $_SESSION["products"] = $products;
}
    }
    function getCustSession(){
    if(!isset($_SESSION["customers"])){
    $customers = array();
    $objs = readObj("Customer", "cust_id", "-1");
    foreach($objs as $obj){
        array_push(
                $customers,
                array(
                    "cust_id"=>$obj["cust_id"],
                    "cust_comp"=>$obj["cust_comp"],
                    "cust_name"=>$obj["cust_name"],
                    "cust_title"=>$obj["cust_title"],
                    "cust_add_1"=>$obj["cust_add_1"],
                    "cust_add_2"=>$obj["cust_add_2"],
                    "cust_city"=>$obj["cust_city"],
                    "cust_cnt_id"=>$obj["cust_cnt_id"],
                    "cust_tel_1"=>$obj["cust_tel_1"],
                    "cust_tel_2"=>$obj["cust_tel_2"],
                    "cust_fax"=>$obj["cust_fax"],
                    "cust_email"=>$obj["cust_email"],
                    "cust_site"=>$obj["cust_site"],
                    "cust_time_stamp"=>$obj["cust_time_stamp"]
                    
                ));
    }
    $_SESSION["customers"] = $customers;
}
    }
    
     function getTransDetailByTransId($trans_det_trans_id){
        global $wsdl;
        $objs = array();
        set_time_limit(0);
        $response = $wsdl->getTransDetailByTransId(array("trans_det_trans_id"=>$trans_det_trans_id));
        if(gettype($response->return) == "array"){
            foreach ($response->return as $obj){
                $obj = get_object_vars($obj);
                array_push($objs,$obj);
            }
        }
        else{
            if(gettype($response->return) == "object"){
                if($response->return->trans_det_id != "-1"){
                    array_push($objs,get_object_vars($response->return));
                }
                
            }
        }
        return $objs;
    }
    
    
      function getBranchSession(){
if(!isset($_SESSION["branches"])){
    $branches = array();
    $objs = readObj("Branch", "bra_id", "-1");
    foreach($objs as $obj){
        array_push(
                $branches, 
                array(
                    "bra_id"=>$obj["bra_id"],
                    "bra_name"=>$obj["bra_name"],
                    "bra_cnt_id"=>$obj["bra_cnt_id"],
                    "bra_city"=>$obj["bra_city"],
                    "bra_add_str"=>$obj["bra_add_str"],
                    "bra_add_1"=>$obj["bra_add_1"],
                    "bra_tel_1"=>$obj["bra_tel_1"],
                    "bra_tel_2"=>$obj["bra_tel_2"],
                    "bra_fax"=>$obj["bra_fax"],
                    "bra_email"=>$obj["bra_email"],
                    "bra_time_stamp"=>$obj["bra_time_stamp"]
                    ));
    }
    $_SESSION["branches"] = $branches;
}
    }