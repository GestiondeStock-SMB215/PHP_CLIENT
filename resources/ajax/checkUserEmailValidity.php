<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";
    
    if (isset($_POST['user_email'])) {
        echo checkUserEmailValidity($_POST['user_email']);
        exit;
    }