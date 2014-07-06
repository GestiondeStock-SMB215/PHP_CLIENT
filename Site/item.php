<?php
$dbconn = dbconnect();
error_reporting(7);
    if (isset($_POST['prod_name']) && ($_POST['prod_name']!="") && 
        isset($_POST['prod_desc']) && ($_POST['user_desc']!="") && 
        isset($_POST['prod_color']) && ($_POST['prod_color']!="") && 
        isset($_POST['']) && ($_POST['user_email']!="")){
        
    
 $query=mysqli_query($dbconn,"INSERT INTO product(prod_name, prod_desc, prod_color)VALUES('".
            mysqli_real_escape_string($prod_name)."', '"
            . mysqli_real_escape_string($prod_desc)."', '"
            . mysqli_real_escape_string($prod_color)."')");

    
    mysqli_close($query);
        
        }
        ?>
        <html>
            <head>
                <style>
                    #clear{margin-bottom: 10px;}
                    #space{margin-left: 5px;}
                    .item{width:700px; background-color: #3c3c3c;color: #fff; font-weight:bold; }
                </style>
            <title>ITEM DEFINITION</title>
            </head>
            <form name="item" action="item.php" method="POST">
                <div class="item">
                    <div>Code
                       <input type="text" size="20px" name="$prod_name" value="<?=$prod_name?>"/>
                    
                         Description
                    <input type="text"  size="60px" name="$prod_name" value="<?=$prod_desc?>"/> 
                    </div>
                     <div id="clear"/>
                     <?php 
                     $limit="6";
                     $s_name=explode(" ",$prod_desc,$limit);
                     ?>
                     <div>Short Name
                     <input type="s_name" value="<?=$s_name;?>"/>
                     
                          Unit
                        <select name="unit">
                            <option name="PCS" value="PCS">PIECES</option>
                            <option name="MTS" value="MTS">METERS</option>
                            <option name="YRD" value="YRD">YARD</option>
                            <option name="BAG" value="BAG">BAG</option>
                        </select>
                                        </div>

                    </div>
        </html>
