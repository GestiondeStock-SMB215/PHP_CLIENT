<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";

    if (isset($_POST['page_name'])) {
        
        $page_parent_id = mysql_escape_mimic($_POST['page_parent_id']);
        $page_name = mysql_escape_mimic($_POST['page_name']);
        $page_url = mysql_escape_mimic($_POST['page_url']);
        $page_acl = mysql_escape_mimic($_POST['page_acl']);
        $page_in_menu = mysql_escape_mimic($_POST['page_in_menu']);
        
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
            global $wsdl;
            set_time_limit(0);
            $response = $wsdl->addPage(array("page_parent_id"=> $page_parent_id,"page_name"=>$page_name, 
                "page_url"=>$page_url, "page_acl"=>  $page_acl,
                "page_in_menu"=>$page_in_menu));

            $result["msg"] = $response->return;
            echo(json_encode($result));        

            exit;
        }
        else{
            echo(json_encode(array("msg"=>"0")));

            exit;
        }
    }