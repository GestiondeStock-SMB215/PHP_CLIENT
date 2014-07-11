<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";

if(isset($_GET['action'])){
    if(function_exists($_GET['action'])){
        call_user_func($_GET['action']);
    }
}

function login(){
    log_toFile($_POST);
    if (isset($_POST['user_username']) && isset($_POST['user_password'])) {
        $user_username = mysql_escape_mimic($_POST['user_username']);
        $user_password = MD5(mysql_escape_mimic($_POST['user_password']));

        //Result array to be encodd into json
        $res = null;

        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->getUserByUsername(array("user_username"=>$user_username, "user_password"=>$user_password));
        
        foreach ($response as $item){
            if($item->user_id == ''){
                $res = "Nom d'usager ou mot de passe sont incorrectes";
                session_destroy();
            }
            else{
                //Inactive
                if($item->user_status == 2){
                    $res = "Votre compte est bloqué.";
                    session_destroy();
                }
                else{
                    $res = "signedIn";
                    
                    $user = null;
                    $user["user_id"] = $item->user_id;
                    $user["user_name"] = $item->user_name;
                    $user["user_username"] = $item->user_username;
                    $user["user_email"] = $item->user_email;
                    $user["user_last_login"] = $item->user_last_login;
                    $user["user_role_id"] = $item->user_role_id;
                    $user["user_status"] = $item->user_status;
                    $user["user_time_stamp"] = $item->user_time_stamp;
                    
                    $_SESSION["user"] = $user;
                    
                    
                }
            }
        }
        die(json_encode(array("d"=>$res)));
    }
}