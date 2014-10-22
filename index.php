<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    
    $branches = readObj("Branch", "bra_id", "-1");
    ?>
<div class="clear"></div>
<div class="mainPage">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTT6dLqL2eRw4eeQ42SvYPGYrTIdhYOCk&sensor=false"></script>
    <script type="text/javascript" src="resources/js/map.js"></script>

<!--    <div class="dashboard">
        
    </div>-->
<div class="dashboard">
    <br/>
    <fieldset>
        <legend>Quick Links</legend>
        <ul>
            <li><a href="orderIn/add.php">New Sale Order</a></li>
            <li><a href="orderOut/add.php">New Purchase Order</a></li>
            <li><a href="prod/add.php">New Product</a></li>
            <li><a href="rep/dash.php">Reports</a></li>
        </ul>
    </fieldset>
    <br/>
    <fieldset>
        <legend>Quick Search</legend>
        <ul>
            <li><a href="orderIn/show.php">View Sales Orders</a></li>
            <li><a href="orderOut/show.php">View Purchases Orders</a></li>
            <li><a href="trans/show.php">All Transfers</a></li>
        </ul>
    </fieldset>
    </br>
    <fieldset>
        <legend>Quick Reports</legend>
        <table>
            <tr><td nowrap><form action="rep/prod.php" method="GET">By Item: <input type="text" name="prod_sku"/><input type="submit" value="GO" style="float: right"/></form></td></tr>
            <tr>
                <td nowrap>
                    <form action="rep/prod.php" method="GET">
                        By Branch: 
                        <select name="bra_id">
                            <?php
                                foreach($branches as $branch){
                                    echo "<option value=\"".$branch["bra_id"]."\">".$branch["bra_name"]."</option>";
                                }
                            ?>
                        </select>
                        <input type="submit" value="GO" style="float: right"/>
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <form action="rep/prodBraQty.php" method="GET">
                        <table><tr><td>Item: <input type="text" name="prod_sku"/></td><br/>
                        <td>in:
                        <select name="bra_id">
                            <?php
                                foreach($branches as $branch){
                                    echo "<option value=\"".$branch["bra_id"]."\">".$branch["bra_name"]."</option>";
                                }
                            ?>
                        </select></td></tr></table><br/>
                        quantity less than: 
                        <input type="number" name="prod_bra_qty" />
                        <input type="submit" value="GO" style="float: right"/>
                    </form>
                </td>
            </tr>
        </table>
    </fieldset>
    
</div>
    <div class="locationMap">
        <div class="mainBox">
            <div class="mainBoxHeader">Location Map</div>
            <div class="mainBoxHeaderLine"></div>
            <div class="mainBoxContent">
                <div id="locationMapLoader"></div>
                <div id="locationMap"></div>
            </div>
        </div>
    </div>
</div>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
