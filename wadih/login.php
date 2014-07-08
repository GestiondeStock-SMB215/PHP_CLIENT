<?php
session_start();
include("../resources/lib.inc.php");
$dbconn = dbconnect();

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    die("password accepted");
}
$array=[];
die(json_encode(array("d"=>$_POST)));
if (isset($_POST['user_username']) && isset($_POST['user_password'])) {
$user_username = $_POST['user_username'];
$user_password = $_POST['user_password'];

if(isset($user_username) && $user_username != null &&  isset($user_password) && $user_password != null){
    $result=mysqli_query($dbconn,"SELECT user_username, user_status, user_password, user_role_id from `user` WHERE ".
             "user_username= '".mysqli_real_escape_string($dbconn,$user_username)."';");
    die($sql);
   
    $array=mysqli_fetch_array($result);
     }
}

if(count($array)==0){
    die(json_encode(array("d"=>"Nom utilisateur/Mot de Passe Invalide.")));
}
if (md5($user_password) == $array["user_password"]) {
    if($array["user_status"]==1){
        $_SESSION['role'] = $array['user_role_id'];
        $_SESSION['loggedIn'] = true ;
        die(json_encode(array("d"=>"signedIn")));
    }else{
        die(json_encode(array("d"=>"Votre nom utilisateur et mot de passe sont correctes mais votre compte est expiré.")));
    }
}else{
    die(json_encode(array("d"=>"Nom utilisateur/Mot de Passe Invalide.")));
}
     
?> 