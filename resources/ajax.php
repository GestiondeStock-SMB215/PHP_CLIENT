<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";
if(isset($_GET["func"])){
    
    if(function_exists($_GET["func"])){
        
        call_user_func($_GET["func"]);
    }
    else{
        logToFile("This function has been called and not found: ".$_GET["func"]);
    }
}

function getUserByUsername(){    
    
    if (isset($_POST['user_username'])&&isset($_POST['user_password'])) {
        $user_username = mysql_escape_mimic($_POST['user_username']);
        $user_password = MD5(mysql_escape_mimic($_POST['user_password']));
        $result = array();
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->getUserByUsername(array("user_username"=>$user_username, "user_password"=>$user_password));            

        foreach ($response as $item){
            if($item->user_id == 0){
                $result["msg"] = "Nom d'usager ou mot de passe sont incorrectes";
                session_destroy();
            }
            else{
                if($item->user_status == 2){
                    $result["msg"] = "Votre compte est bloqué.";
                    session_destroy();
                }
                else{
                    $result["msg"] = "signedIn";                    
                    $uull = $wsdl->UpdateUserLastLogin(array("user_id" => $item->user_id));
                    
                    $user = null;
                    $user["user_id"] = $item->user_id;
                    $user["user_name"] = $item->user_name;
                    $user["user_username"] = $item->user_username;
                    $user["user_email"] = $item->user_email;
                    $user["user_last_login"] = $item->user_last_login;
                    $user["user_role_id"] = $item->user_role_id;
                    $user["user_status"] = $item->user_status;
                    $user["user_bra_id"] = $item->user_bra_id;
                    $user["user_time_stamp"] = $item->user_time_stamp;
                    
                    //TO BE UN-COMMENTED ON PRODUCTION
                    //getPages($item->user_role_id);
                    
                    $_SESSION["user"] = $user;
                    
                    getPages($item->user_role_id);
                }                
            }
        }
        echo(json_encode($result));
        exit;
    }
}

function checkUserNameValidity(){
    if (isset($_POST['user_username'])) {
        
        $user_username = mysql_escape_mimic($_POST['user_username']);
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
        echo json_encode($result);
        exit;
    }
}

function checkUserEmailValidity(){
    if (isset($_POST['user_email'])) {
        $user_email = mysql_escape_mimic($_POST['user_email']);
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
        
        echo json_encode($result);
        exit;
    }
}

function addPage(){
    if (isset($_POST['page_name'])) {
        
        $page_parent_id = mysql_escape_mimic($_POST['page_parent_id']);
        $page_name = mysql_escape_mimic($_POST['page_name']);
        $page_url = mysql_escape_mimic($_POST['page_url']);
        $page_acl = mysql_escape_mimic($_POST['page_acl']);
        $page_in_menu = mysql_escape_mimic($_POST['page_in_menu']);
        $page_order = mysql_escape_mimic($_POST['page_order']);
        
        global $wsdl;
        set_time_limit(0);
        $page_exist = false;
        $response = $wsdl->getPages(array("user_role_id"=>"0"));
        foreach($response as $return){
            foreach ($return as $page){
                if($page->page_url == $page_url && $page->page_url != ""){
                    $page_exist = true;
                }
            }
        }
        
        if(!$page_exist){
            createPageDirectory($page_url);

            $result = array();
            $res = aeObj(
                "Page",
                array(
                    "page_id"=>"-1",
                    "page_parent_id"=> $page_parent_id,
                    "page_name"=>$page_name, 
                    "page_url"=>$page_url, 
                    "page_acl"=>  $page_acl,
                    "page_in_menu"=>$page_in_menu, 
                    "page_order"=>$page_order
                )
            );

            $result["msg"] = $res;
            logToFile(json_encode($result));
            echo(json_encode($result));        

            exit;
        }
        else{
            echo(json_encode(array("msg"=>"0")));

            exit;
        }
    }
}

function addUser(){    
    if (isset($_POST['user_name'])) {
        
        $user_role_id = mysql_escape_mimic($_POST['user_role_id']);
        $user_name = mysql_escape_mimic($_POST['user_name']);
        $user_username = mysql_escape_mimic($_POST['user_username']);
        $user_password = mysql_escape_mimic($_POST['user_password']);
        $user_email = mysql_escape_mimic($_POST['user_email']);
        $user_status = mysql_escape_mimic($_POST['user_status']);
        $user_bra_id = mysql_escape_mimic($_POST['user_bra_id']);
        $result = array();
        
        $res = aeObj(
            "User", 
            array(
                "user_id" => "-1",
                "user_role_id"=> $user_role_id,
                "user_bra_id"=>$user_bra_id,
                "user_name"=>$user_name, 
                "user_username"=>$user_username, 
                "user_password"=>  md5($user_password),
                "user_email"=>$user_email, 
                "user_status"=>$user_status                
            )
        );     
        
        $result["msg"] = $res;
        echo(json_encode($result));
        exit;
    }
}

function editUser(){
    if (isset($_POST['user_name'])) {
        $user_id = mysql_escape_mimic($_POST['user_id']);
        $user_role_id = mysql_escape_mimic($_POST['user_role_id']);
        $user_bra_id = mysql_escape_mimic($_POST['user_bra_id']);
        $user_name = mysql_escape_mimic($_POST['user_name']);
        $user_username = mysql_escape_mimic($_POST['user_username']);
        $user_password = mysql_escape_mimic($_POST['user_password']);
        if($user_password==""){
            $user_password = "-1";
        }
        $user_password = md5($user_password);
        
        $user_email = mysql_escape_mimic($_POST['user_email']);
        $user_status = mysql_escape_mimic($_POST['user_status']);
        $result = array();
        
        $res = aeObj(
            "User", 
            array(
                "user_id" => $user_id,
                "user_role_id"=>$user_role_id, 
                "user_bra_id"=>$user_bra_id,
                "user_name"=>$user_name, 
                "user_username"=>$user_username, 
                "user_password"=>$user_password,
                "user_email"=>$user_email,
                "user_status"=>$user_status
            )
        );
        $result["msg"] = $res;
        echo(json_encode($result));
        exit;
    }
}

function addCategory(){
    if (isset($_POST['cat_name'])) {
        $cat_name = mysql_escape_mimic($_POST['cat_name']);
        $cat_desc = mysql_escape_mimic($_POST['cat_desc']);
//        logToFile($_POST);
        $res = aeObj(
            "Category", 
            array(
                "cat_id"=>"-1",
                "cat_name"=>$cat_name,
                "cat_desc"=>$cat_desc
            )
        );
        $result = array();


        $result["msg"] = $res;
        echo(json_encode($result));        

        exit;
    }
}

function editCategory(){
    if (isset($_POST['cat_id'])) {
        $cat_id = mysql_escape_mimic($_POST['cat_id']);
        $cat_name = mysql_escape_mimic($_POST['cat_name']);
        $cat_desc = mysql_escape_mimic($_POST['cat_desc']);
   
        $result = array();
        
        $res = aeObj(
            "Category", 
            array(
                "cat_id" => $cat_id,
                "cat_name"=>$cat_name, 
                "cat_desc"=>$cat_desc
            )
        );
        $result["msg"] = $res;
        echo(json_encode($result));
        exit;
    }
}

function addBranch(){
    if (isset($_POST['bra_name'])) {
        
        $bra_name = mysql_escape_mimic($_POST['bra_name']);
        $bra_cnt_id = mysql_escape_mimic($_POST['bra_cnt_id']);
        $bra_city = mysql_escape_mimic($_POST['bra_city']);
        $bra_add_str = mysql_escape_mimic($_POST['bra_add_str']);
        $bra_add_1 = mysql_escape_mimic($_POST['bra_add_1']);
        $bra_tel_1 = mysql_escape_mimic($_POST['bra_tel_1']);
        $bra_tel_2 = mysql_escape_mimic($_POST['bra_tel_2']);
        $bra_fax = mysql_escape_mimic($_POST['bra_fax']);
        $bra_email = mysql_escape_mimic($_POST['bra_email']);
        $res = aeObj(
            "Branch", 
            array(
               "bra_id"    => "-1",
               "bra_name"   => $bra_name,
               "bra_cnt_id" => $bra_cnt_id,
               "bra_city"   => $bra_city, 
               "bra_add_str"=> $bra_add_str,
               "bra_add_1"  => $bra_add_1,
               "bra_tel_1"  => $bra_tel_1,
               "bra_tel_2"  => $bra_tel_2, 
               "bra_fax"    => $bra_fax,
               "bra_email"  => $bra_email
            )
        );
        $result = array();
        $result["msg"] = $res;
        echo(json_encode($result));
        
        exit;
    }
}

function editBranch(){
    if (isset($_POST['bra_id'])) {
        $bra_id = mysql_escape_mimic($_POST['bra_id']);
        $bra_name = mysql_escape_mimic($_POST['bra_name']);
        $bra_cnt_id = mysql_escape_mimic($_POST['bra_cnt_id']);
        $bra_city = mysql_escape_mimic($_POST['bra_city']);
        $bra_add_str = mysql_escape_mimic($_POST['bra_add_str']);
        $bra_add_1 = mysql_escape_mimic($_POST['bra_add_1']);
        $bra_tel_1 = mysql_escape_mimic($_POST['bra_tel_1']);
        $bra_tel_2 = mysql_escape_mimic($_POST['bra_tel_2']);
        $bra_fax = mysql_escape_mimic($_POST['bra_fax']);
        $bra_email = mysql_escape_mimic($_POST['bra_email']);
        $res = aeObj(
            "Branch", 
            array(
               "bra_id"=> $bra_id,
               "bra_name"=> $bra_name,
               "bra_cnt_id"=> $bra_cnt_id,
               "bra_city"=>$bra_city, 
               "bra_add_str"=>$bra_add_str,
               "bra_add_1"=> $bra_add_1,
               "bra_tel_1"=>  $bra_tel_1,
               "bra_tel_2"=>$bra_tel_2, 
               "bra_fax"=>$bra_fax,
               "bra_email"=>$bra_email
            )
        );

        $result["msg"] = $res;
        echo(json_encode($result));        
        
        exit;
    }

}

function addCustomer(){
    logToFile(json_encode($_POST));
    if (isset($_POST['cust_comp'])) {
        $cust_comp = mysql_escape_mimic($_POST['cust_comp']);
        $cust_name = mysql_escape_mimic($_POST['cust_name']);
        $cust_title = mysql_escape_mimic($_POST['cust_title']);
        $cust_add_1 = mysql_escape_mimic($_POST['cust_add_1']);
        $cust_add_2 = mysql_escape_mimic($_POST['cust_add_2']);
        $cust_city = mysql_escape_mimic($_POST['cust_city']);
        $cust_cnt_id = mysql_escape_mimic($_POST['cust_cnt_id']);
        $cust_tel_1 = mysql_escape_mimic($_POST['cust_tel_1']);
        $cust_tel_2 = mysql_escape_mimic($_POST['cust_tel_2']);
        $cust_fax = mysql_escape_mimic($_POST['cust_fax']);
        $cust_email = mysql_escape_mimic($_POST['cust_email']);
        $cust_site = mysql_escape_mimic($_POST['cust_site']);
       
        $res = aeObj(
            "Customer", 
        array(
            "cust_id"=>"-1",
            "cust_comp"=>$cust_comp,
            "cust_name"=>$cust_name,
            "cust_title"=>$cust_title, 
            "cust_add_1"=>$cust_add_1,
            "cust_add_2"=>$cust_add_2,
            "cust_city"=>$cust_city,
            "cust_cnt_id"=>$cust_cnt_id,
            "cust_tel_1"=>$cust_tel_1,
            "cust_tel_2"=>$cust_tel_2,
            "cust_fax"=>$cust_fax,
            "cust_email"=>$cust_email,
            "cust_site"=>$cust_site
            
        )
    );

        $result["msg"] = $res;
        echo(json_encode($result));        
        
        exit;
    }
}
function editCustomer(){
//    logToFile(json_encode($_POST));
    if (isset($_POST['cust_id'])) {
        $cust_id   = mysql_escape_mimic($_POST['cust_id']);
        $cust_comp = mysql_escape_mimic($_POST['cust_comp']);
        $cust_name = mysql_escape_mimic($_POST['cust_name']);
        $cust_title = mysql_escape_mimic($_POST['cust_title']);
        $cust_add_1 = mysql_escape_mimic($_POST['cust_add_1']);
        $cust_add_2 = mysql_escape_mimic($_POST['cust_add_2']);
        $cust_city = mysql_escape_mimic($_POST['cust_city']);
        $cust_cnt_id = mysql_escape_mimic($_POST['cust_cnt_id']);
        $cust_tel_1 = mysql_escape_mimic($_POST['cust_tel_1']);
        $cust_tel_2 = mysql_escape_mimic($_POST['cust_tel_2']);
        $cust_fax = mysql_escape_mimic($_POST['cust_fax']);
        $cust_email = mysql_escape_mimic($_POST['cust_email']);
        $cust_site = mysql_escape_mimic($_POST['cust_site']);
       
        
        $res = aeObj(
            "Customer", 
        array(
            "cust_id"=>$cust_id,
            "cust_comp"=>$cust_comp,
            "cust_name"=>$cust_name,
            "cust_title"=>$cust_title, 
            "cust_add_1"=>$cust_add_1,
            "cust_add_2"=>$cust_add_2,
            "cust_city"=>$cust_city,
            "cust_cnt_id"=>$cust_cnt_id,
            "cust_tel_1"=>$cust_tel_1,
            "cust_tel_2"=>$cust_tel_2,
            "cust_fax"=>$cust_fax,
            "cust_email"=>$cust_email,
            "cust_site"=>$cust_site
        )
    );

        $result["msg"] = $res;
        echo(json_encode($result));        
        
        exit;
    }
}

function addProduct(){
//    logToFile(json_encode($_POST));
    if (isset($_POST['prod_cat_id'])) {
        $prod_cat_id = mysql_escape_mimic($_POST['prod_cat_id']);
        $prod_sku = mysql_escape_mimic($_POST['prod_sku']);
        $prod_upc = mysql_escape_mimic($_POST['prod_upc']);
        $prod_name = mysql_escape_mimic($_POST['prod_name']);
        $prod_desc = mysql_escape_mimic($_POST['prod_desc']);
//      $prod_qty = mysql_escape_mimic($_POST['prod_qty']);
        $prod_color = mysql_escape_mimic($_POST['prod_color']);
        $prod_size = mysql_escape_mimic($_POST['prod_size']);
        $prod_weight = mysql_escape_mimic($_POST['prod_weight']);
        $prod_sup_id = mysql_escape_mimic($_POST['prod_sup_id']);
        $prod_status = mysql_escape_mimic($_POST['prod_status']);
        $prod_vend_id = mysql_escape_mimic($_POST['prod_vend_id']);
        
        $res = aeObj(
            "Product", 
            array(
                "prod_id" => "-1",
                "prod_cat_id"=>$prod_cat_id,
                "prod_sku"=>$prod_sku,
                "prod_upc"=>$prod_upc, 
                "prod_name"=>$prod_name,
                "prod_desc"=>$prod_desc,
                "prod_qty"=>"0",
                "prod_color"=>$prod_color,
                "prod_size"=>$prod_size,
                "prod_weight"=>$prod_weight,
                "prod_sup_id"=>$prod_sup_id,
                "prod_status"=>$prod_status,
                "prod_vend_id"=>$prod_vend_id
            )
        );
        
        $result["msg"] = "$res";
        
//        logToFile(json_encode($result));
        echo(json_encode($result));        

        exit;
    }
}
function editProduct(){
//    logToFile(json_encode($_POST));
    if (isset($_POST['prod_id'])) {
        $prod_id = mysql_escape_mimic($_POST['prod_id']);
        $prod_cat_id = mysql_escape_mimic($_POST['prod_cat_id']);
        $prod_sku = mysql_escape_mimic($_POST['prod_sku']);
        $prod_upc = mysql_escape_mimic($_POST['prod_upc']);
        $prod_name = mysql_escape_mimic($_POST['prod_name']);
        $prod_desc = mysql_escape_mimic($_POST['prod_desc']);
//      $prod_qty = mysql_escape_mimic($_POST['prod_qty']);
        $prod_color = mysql_escape_mimic($_POST['prod_color']);
        $prod_size = mysql_escape_mimic($_POST['prod_size']);
        $prod_weight = mysql_escape_mimic($_POST['prod_weight']);
        $prod_sup_id = mysql_escape_mimic($_POST['prod_sup_id']);
        $prod_vend_id = mysql_escape_mimic($_POST['prod_vend_id']);
        $prod_status = mysql_escape_mimic($_POST['prod_status']);
        
        $res = aeObj(
            "Product", 
            array(
                "prod_id" =>$prod_id,
                "prod_cat_id"=>$prod_cat_id,
                "prod_sku"=>$prod_sku,
                "prod_upc"=>$prod_upc, 
                "prod_name"=>$prod_name,
                "prod_desc"=>$prod_desc,
                "prod_qty"=>"0",
                "prod_color"=>$prod_color,
                "prod_size"=>$prod_size,
                "prod_weight"=>$prod_weight,
                "prod_sup_id"=>$prod_sup_id,
                "prod_status"=>$prod_status, 
                "prod_vend_id"=>$prod_vend_id
            )
        );
        
        $result["msg"] = "$res";
        
//        logToFile(json_encode($result));
        echo(json_encode($result));        

        exit;
    }
}
function addSupplier(){
    if (isset($_POST['sup_comp'])) {
        
        $sup_comp = mysql_escape_mimic($_POST['sup_comp']);
        $sup_name = mysql_escape_mimic($_POST['sup_name']);
        $sup_title = mysql_escape_mimic($_POST['sup_title']);
        $sup_add_1 = mysql_escape_mimic($_POST['sup_add_1']);
        $sup_add_2 = mysql_escape_mimic($_POST['sup_add_2']);
        $sup_city = mysql_escape_mimic($_POST['sup_city']);
        $sup_cnt_id = mysql_escape_mimic($_POST['sup_cnt_id']);
        $sup_tel_1 = mysql_escape_mimic($_POST['sup_tel_1']);
        $sup_tel_2 = mysql_escape_mimic($_POST['sup_tel_2']);
        $sup_fax = mysql_escape_mimic($_POST['sup_fax']);
        $sup_email = mysql_escape_mimic($_POST['sup_email']);
        $sup_site = mysql_escape_mimic($_POST['sup_site']);
        
        $res = aeObj(
            "Supplier", 
            array(
                "sup_id" => "-1",
                "sup_comp"=>$sup_comp,
                "sup_name"=>$sup_name,
                "sup_title"=>$sup_title, 
                "sup_add_1"=>$sup_add_1,
                "sup_add_2"=>$sup_add_2,
                "sup_city"=>$sup_city,
                "sup_cnt_id"=>$sup_cnt_id,
                "sup_tel_1"=>$sup_tel_1,
                "sup_tel_2"=>$sup_tel_2,
                "sup_fax"=>$sup_fax,
                "sup_email"=>$sup_email,
                "sup_site"=>$sup_site
                )
             );

        $result["msg"] = "$res";
        
//        logToFile(json_encode($result));
        echo(json_encode($result));        

        exit;
    }
}
function editSupplier(){
    if (isset($_POST['sup_comp'])) {
        
        $sup_id = mysql_escape_mimic($_POST['sup_id']);
        $sup_comp = mysql_escape_mimic($_POST['sup_comp']);
        $sup_name = mysql_escape_mimic($_POST['sup_name']);
        $sup_title = mysql_escape_mimic($_POST['sup_title']);
        $sup_add_1 = mysql_escape_mimic($_POST['sup_add_1']);
        $sup_add_2 = mysql_escape_mimic($_POST['sup_add_2']);
        $sup_city = mysql_escape_mimic($_POST['sup_city']);
        $sup_cnt_id = mysql_escape_mimic($_POST['sup_cnt_id']);
        $sup_tel_1 = mysql_escape_mimic($_POST['sup_tel_1']);
        $sup_tel_2 = mysql_escape_mimic($_POST['sup_tel_2']);
        $sup_fax = mysql_escape_mimic($_POST['sup_fax']);
        $sup_email = mysql_escape_mimic($_POST['sup_email']);
        $sup_site = mysql_escape_mimic($_POST['sup_site']);
        
        $res = aeObj(
            "Supplier", 
            array(
                "sup_id" =>$sup_id,
                "sup_comp"=>$sup_comp,
                "sup_name"=>$sup_name,
                "sup_title"=>$sup_title, 
                "sup_add_1"=>$sup_add_1,
                "sup_add_2"=>$sup_add_2,
                "sup_city"=>$sup_city,
                "sup_cnt_id"=>$sup_cnt_id,
                "sup_tel_1"=>$sup_tel_1,
                "sup_tel_2"=>$sup_tel_2,
                "sup_fax"=>$sup_fax,
                "sup_email"=>$sup_email,
                "sup_site"=>$sup_site
                )
             );

        $result["msg"] = "$res";
        
//        logToFile(json_encode($result));
        echo(json_encode($result));        

        exit;
    }
}

function addOrderOut(){
    if (isset($_POST['order_out_sup_id'])) {
        
        $order_out_sup_id = mysql_escape_mimic($_POST['order_out_sup_id']);
        $order_out_date = mysql_escape_mimic($_POST['order_out_date']);
        $order_out_del_date = mysql_escape_mimic($_POST['order_out_del_date']);
        $order_status = mysql_escape_mimic($_POST['order_status']);
       
       
        
        $res = aeObj(
            "OrderOut", 
            array(
                "order_out_id" => "-1",
                "order_out_sup_id"=>$order_out_sup_id,
                "order_out_date"=>$order_out_date,
                "order_out_del_date"=>$order_out_del_date, 
                "order_status"=>$order_status
                )
             );

        $result["msg"] = "$res";
        
//        logToFile(json_encode($result));
        echo(json_encode($result));        

        exit;
    }
}
function editOrderOut(){
    if (isset($_POST['order_out_id'])) {
        
        $order_out_id = mysql_escape_mimic($_POST['order_out_id']);
        $order_out_sup_id = mysql_escape_mimic($_POST['order_out_sup_id']);
        $order_out_date = mysql_escape_mimic($_POST['order_out_date']);
        $order_out_del_date = mysql_escape_mimic($_POST['order_out_del_date']);
        $order_status = mysql_escape_mimic($_POST['order_status']);
       
        
        $res = aeObj(
            "OrderOut", 
            array(
                "order_out_id" => $order_out_id,
                "order_out_sup_id"=>$order_out_sup_id,
                "order_out_date"=>$order_out_date,
                "order_out_del_date"=>$order_out_del_date, 
                "order_status"=>$order_status
                )
             );

        $result["msg"] = "$res";
        
//        logToFile(json_encode($result));
        echo(json_encode($result));        

        exit;
    }
}


function addOrderOutDet(){
    if (isset($_POST['order_out_det_order_id'])) {
        
        $order_out_det_order_id = mysql_escape_mimic($_POST['order_out_det_order_id']);
        $order_out_det_prod_id = mysql_escape_mimic($_POST['order_out_det_prod_id']);
        $order_out_det_qty = mysql_escape_mimic($_POST['order_out_det_qty']);
       
       
        
        $res = aeObj(
            "OrderOutDet", 
            array(
                "order_out_det_id" => "-1",
                "order_out_det_order_id"=>$order_out_det_order_id,
                "order_out_det_prod_id"=>$order_out_det_prod_id,
                "order_out_det_qty"=>$order_out_det_qty
                )
             );

        $result["msg"] = "$res";
        
//        logToFile(json_encode($result));
        echo(json_encode($result));        

        exit;
    }
}
function editOrderOutDet(){
    if (isset($_POST['order_out_det_id'])) {
        
        $order_out_det_id = mysql_escape_mimic($_POST['order_out_det_id']);
        $order_out_det_order_id = mysql_escape_mimic($_POST['order_out_det_order_id']);
        $order_out_det_prod_id = mysql_escape_mimic($_POST['order_out_det_prod_id']);
        $order_out_det_qty = mysql_escape_mimic($_POST['order_out_det_qty']);
       
        
        $res = aeObj(
            "OrderOutDet", 
            array(
                "order_out_det_id" => $order_out_det_id,
                "order_out_det_order_id"=>$order_out_det_order_id,
                "order_out_det_prod_id"=>$order_out_det_prod_id,
                "order_out_det_qty"=>$order_out_det_qty
                )
             );

        $result["msg"] = "$res";
        
//        logToFile(json_encode($result));
        echo(json_encode($result));        

        exit;
    }
}
function addShipper(){
    if (isset($_POST['ship_name'])) {
        
        $ship_name = mysql_escape_mimic($_POST['ship_name']);
        $ship_type = mysql_escape_mimic($_POST['ship_type']);
        $ship_add_1 = mysql_escape_mimic($_POST['ship_add_1']);
        $ship_add_2 = mysql_escape_mimic($_POST['ship_add_2']);
        $ship_tel_1 = mysql_escape_mimic($_POST['ship_tel_1']);
        $ship_tel_2 = mysql_escape_mimic($_POST['ship_tel_2']);
        $ship_fax = mysql_escape_mimic($_POST['ship_fax']);
        $ship_email = mysql_escape_mimic($_POST['ship_email']);
        $ship_taxable = mysql_escape_mimic($_POST['ship_taxable']);
        
        $res = aeObj(
            "Shipper", 
            array(
                "ship_id" => "-1",
                "ship_name"=>$ship_name,
                "ship_type"=>$ship_type,
                "ship_add_1"=>$ship_add_1, 
                "ship_add_2"=>$ship_add_2,
                "ship_tel_1"=>$ship_tel_1,
                "ship_tel_2"=>$ship_tel_2,
                "ship_fax"=>$ship_fax,
                "ship_email"=>$ship_email,
                "ship_taxable"=>$ship_taxable
                )
             );

        $result["msg"] = "$res";
        
//        logToFile(json_encode($result));
        echo(json_encode($result));        

        exit;
    }
}
function editShipper(){
    if (isset($_POST['ship_id'])) {
        
        $ship_id   = mysql_escape_mimic($_POST['ship_id']);
        $ship_name = mysql_escape_mimic($_POST['ship_name']);
        $ship_type = mysql_escape_mimic($_POST['ship_type']);
        $ship_add_1 = mysql_escape_mimic($_POST['ship_add_1']);
        $ship_add_2 = mysql_escape_mimic($_POST['ship_add_2']);
        $ship_tel_1 = mysql_escape_mimic($_POST['ship_tel_1']);
        $ship_tel_2 = mysql_escape_mimic($_POST['ship_tel_2']);
        $ship_fax = mysql_escape_mimic($_POST['ship_fax']);
        $ship_email = mysql_escape_mimic($_POST['ship_email']);
        $ship_taxable = mysql_escape_mimic($_POST['ship_taxable']);
        
        $res = aeObj(
            "Shipper", 
            array(
                "ship_id" => $ship_id,
                "ship_name"=>$ship_name,
                "ship_type"=>$ship_type,
                "ship_add_1"=>$ship_add_1, 
                "ship_add_2"=>$ship_add_2,
                "ship_tel_1"=>$ship_tel_1,
                "ship_tel_2"=>$ship_tel_2,
                "ship_fax"=>$ship_fax,
                "ship_email"=>$ship_email,
                "ship_taxable"=>$ship_taxable
                )
             );

        $result["msg"] = "$res";
        
//        logToFile(json_encode($result));
        echo(json_encode($result));        

        exit;
    }
}
function getDesc(){
    if(isset($_POST['prod_id'])){
        
        $prod_id   = mysql_escape_mimic($_POST['prod_id']);
//        $prod_id=1;
        $res = readObj("Product","prod_id", $prod_id);
        
//        logToFile(json_encode($result));
        echo(json_encode($res[0]['prod_desc']));        

        exit;
                
    }
}
 function getPrice(){
    if(isset($_POST['prod_id'])){
        
        $prod_id   = mysql_escape_mimic($_POST['prod_id']);
//        $prod_id=1;
        $res = readObj("Product","prod_id", $prod_id);
        
//        logToFile(json_encode($result));
        echo(json_encode($res[0]['prod_vend_id']));        

        exit;
                
    }
}
function getCustIdByName(){
    $cust_name = mysql_escape_mimic($_POST['cust_name']);
    $result = array();
    global $wsdl;
    set_time_limit(0);
    $response = $wsdl->getCustIdByName(array("cust_name"=>$cust_name));               
    $response = $response->return;
    if(sizeof($response) > 1){
        foreach($response as $custItem){

            array_push(
                $result, 
                array(
                    "cust_name"=>$custItem->cust_name,
                    "cust_id"=>$custItem->cust_id
                )
            );
        }        
    }
    else{
        array_push(
            $result, 
            array(
                "cust_name" => $response->cust_name,
                "cust_id" => $response->cust_id
            )
        );
    }   
    echo(json_encode($result));
    exit;
}
function getSupIdByName(){
    $sup_name = mysql_escape_mimic($_POST['sup_name']);
    $result = array();
    global $wsdl;
    set_time_limit(0);
    $response = $wsdl->getSupIdByName(array("sup_name"=>$sup_name));               
    $response = $response->return;
    if(sizeof($response) > 1){
        foreach($response as $supItem){

            array_push(
                $result, 
                array(
                    "sup_name"=>$supItem->sup_name,
                    "sup_id"=>$supItem->sup_id
                )
            );
        }        
    }
    else{
        array_push(
            $result, 
            array(
                "sup_name" => $response->sup_name,
                "sup_id" => $response->sup_id
            )
        );
    }   
    echo(json_encode($result));
    exit;
}
function checkProdQtyByBranch(){
    $result = array();
    $array = array("prod_id"=>$_POST["prod_id"], "trans_src_bra_id"=>$_POST["trans_src_bra_id"]);
    global $wsdl;
    $res = $wsdl->checkProdQtyByBranch($array)->return;
    logToFile($res);
    array_push($result,$res);
    echo(json_encode($result));
    exit;
}