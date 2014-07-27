<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";
?>

<html>
    <head>
        <title>GSS - Cnam Liban</title>
        <link rel="icon" type="image/png" href="img/btn/favicon.png" />        
        <script src="/resources/js/jquery-1.11.0.js"></script>   
        <script src="/resources/js/main.js"></script>   
        
        <link type="text/css" rel="stylesheet" href="/resources/css/style.css" />
        <meta content="utf-8" http-equiv="encoding" />
    </head>
    <body>
        <?php
            if($_SERVER['PHP_SELF'] != "/login.php"){
        ?>
        <div class="header">
            <div class="innerHead">
                <a href="/index.php"><div class="logo"></div></a>
                <div class="leftHeader">
                    <div class="welcome">Welcome  <?= $_SESSION["user"]["user_name"] ?></div>
                </div>
                <div class="menu">
                    <?= getMenu($_SESSION["user"]["user_role_id"]) ?>
                </div>
                
                <div class="pnlLogin">
                    <div class="lgnTop" style="left:54px;"></div>
                    <div id="divLoggedIn" class="lgnCont">
                        <a href="user/profile.php">My Profile</a><div class="clear"></div>
                        <a href="/logout.php">LOGOUT</a>
                    </div>                                
                </div>
            </div>
        </div>
        <?php
            }
        ?>
