<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";
?>
<DOCTYPE html>
<html>
    <head>
        <title>GSS - Cnam Liban</title>
        <link rel="icon" type="image/png" href="/favicon.png">
        
        <script src="/resources/js/jquery-1.8.3.min.js"></script>   
        <script src="/resources/js/datatables.js"></script>   
        <script src="/resources/js/tabetools.js"></script>   
        <script src="/resources/js/main.js"></script> 
        <script type="text/javascript" src="/resources/js/jquery.ui.datepicker.js"></script>

        <link href="/resources/css/jquery.ui.datepicker.css" rel="stylesheet" /> 
        <link type="text/css" rel="stylesheet" href="/resources/css/style.css" />
        <link type="text/css" rel="stylesheet" href="/resources/css/datatables.css" />
        <link type="text/css" rel="stylesheet" href="/resources/css/tabletools.css" />
        <meta content="utf-8" http-equiv="encoding" />
    </head>
    <body>
        <script>
        $(document).ready(function(){  
            
            $('.welcome').click(function () {
                $('.pnlLogin').slideToggle("slide");
            });

            $('.title').click(function(){
                var id = $(this).html();
                $('.sub').slideUp(); 
                $('#' + id).slideToggle();  
                var child = $("#" + id + " > li").length;
                if (child != 0){
                    var up = (child-1)*24;
                    $(".main").css('top','-'+up+'px');
                }
                else{
                    $(".main").css('top','0px');
                }
            });
        });
        </script>  
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
                        <a href="/user/profile.php">My Profile</a><div class="clear"></div>
                        <a href="/logout.php">LOGOUT</a>
                    </div>                                
                </div>
            </div>
        </div>
        <?php
            }
        ?>
        <div class="main">