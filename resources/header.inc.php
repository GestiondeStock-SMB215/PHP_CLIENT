<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>GSS - Cnam Liban</title>
        <link rel="icon" type="image/png" href="img/btn/favicon.png" />        
        <script src="/resources/js/jquery-1.11.0.js"></script>   
        <script src="/resources/js/jquery.min.js"></script>   
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
                <div class="menu">
                    <div class="topMenu">
                        <div class="title">Product</div>
                        <div id="Product" class="sub">
                            <div class="ttlSub">New</div>
                            <div class="ttlSub">Show All</div>
                        </div>
                    </div>
                    <div class="topMenu">
                        <div class="title">Category</div>
                        <div id="Category" class="sub">
                            <div class="ttlSub"><a href="../cat/addCategory.php">New</a></div>
                            <div class="ttlSub"><a href="../cat/showAllCategories.php">Show All</a></div>
                        </div>
                    </div>
                    <div class="topMenu">
                        <div class="title">Brand</div>
                        <div id="Brand" class="sub">
                            <div class="ttlSub">New</div>
                            <div class="ttlSub">Show All</div>
                        </div>
                    </div>
                    <div class="topMenu">
                        <div class="title">Country</div>
                        <div id="Country" class="sub">
                            <div class="ttlSub">New</div>
                            <div class="ttlSub">Show All</div>
                        </div>
                    </div>
                    <div class="topMenu">
                        <div class="title">Shipper</div>
                        <div id="Shipper" class="sub">
                            <div class="ttlSub">New</div>
                            <div class="ttlSub">Show All</div>
                        </div>
                    </div>    
                    <div class="topMenu">
                        <div class="title">Payable</div>
                        <div id="Payable" class="sub">
                            <div class="ttlSub">P.Order</div>
                            <div class="ttlSub">P.Invoice</div>
                            <div class="ttlSub">Supplier</div>
                        </div>
                    </div>  
                    <div class="topMenu">
                        <div class="title" style="width:90px;">Receivable</div>
                        <div id="Receivable" class="sub" style="width:90px;">
                            <div class="ttlSub" style="width:90px;">Sale Order</div>
                            <div class="ttlSub" style="width:90px;">Sale Invoice</div>
                            <div class="ttlSub" style="width:90px;">Customer</div>
                        </div>
                    </div>
                    <div class="topMenu">
                        <div class="title">Transfer</div>
                        <div id="Payable" class="sub">
                            <div class="ttlSub">New</div>
                            <div class="ttlSub">Show All</div>
                        </div>
                    </div> 
                    <div class="topMenu">
                        <div class="title">Reports</div>
                        <div id="Reports" class="sub">
                            <div class="ttlSub">New</div>
                            <div class="ttlSub">Show All</div>
                        </div>
                    </div> 
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