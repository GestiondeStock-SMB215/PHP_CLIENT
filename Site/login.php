<?php
session_start();

if ($_SESSION['loggedIn'] == true) {
    die("password accepted");
}

$user_username = $_POST[user_username];
$user_password = $_POST[user_password];
$array=[];
if(isset($user_username) && $user_username != null ||
     isset($user_password) && $user_password != null){
    $sql="SELECT user_username, user_status, user_password, user_role_id from user WHERE ".
             "user_username= ".mysql_real_escape_string($user_username);
    $result = mysql_query($sql);
    $array=mysql_fetch_array($result);
     }
if(count($array)==0){
    die("Error");
}
if (md5($user_password) == $array["user_password"]) {
    if($array["user_status"]==1){
        $_SESSION['role'] = $array['user_role_id'];
        $_SESSION['loggedIn'] = true ;
        die("You are logged in");
    }else{
        die("expired");
    }
}else{
    die("Error");
}
     
?> 
