<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>GSS - Cnam Liban</title>
        <link rel="icon" type="image/png" href="img/btn/favicon.png" />        
        <script src="/resources/js/jquery-1.11.0.js"></script>       
        <link type="text/css" rel="stylesheet" href="/resources/css/style.css" />
        <meta content="utf-8" http-equiv="encoding" />
    </head>
    <body>
        <?php
            if($_SERVER['PHP_SELF'] != "/login.php"){
        ?>
        <div class="header">
            <div class="innerHead">
                <div class="logo"></div>
                <div class="leftHeader">
                    <div class="welcome">Welcome  <?= $_SESSION["user"]["user_name"] ?></div>
                </div>
                <div class="pnlLogin">
                    <div class="lgnTop" style="left:54px;"></div>
                    <div id="divLoggedIn" class="lgnCont">
                        <a href="">My Profile</a><div class="clear"></div>
                        <a href="/logout.php">LOGOUT</a>
                    </div>                                
                </div>
            </div>
        </div>
        <?php
            }
        ?>