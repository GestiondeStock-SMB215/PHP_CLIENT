<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";
    
    if (isset($_POST['user_username'])) {
        echo checkUserNameValidity($_POST['user_username']);
        exit;
    }