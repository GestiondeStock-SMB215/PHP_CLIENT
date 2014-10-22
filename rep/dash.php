<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";

    $branches = readObj("Branch", "bra_id", "-1");
    getProdSession();
?>
<h1>REPORTS</h1>
<table id="report" cellspacing="10">
    
            <tr><td nowrap><form action="prod.php" method="GET">By Item: <input type="text" name="prod_sku"/><input type="submit" value="GO" style="float: right"/></form></td></tr>
            <tr>
                <td nowrap>
                    <form action="bra.php" method="GET">
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
                    <form action="prodBraQty.php" method="GET">
                        Item: <input type="text" name="prod_sku"/>
                        in:
                        <select name="bra_id">
                            <?php
                                foreach($branches as $branch){
                                    echo "<option value=\"".$branch["bra_id"]."\">".$branch["bra_name"]."</option>";
                                }
                            ?>
                        </select>
                        quantity less than: 
                        <input type="number" name="prod_bra_qty" />
                        <input type="submit" value="GO" style="float: right"/>
                    </form>
                </td>
            </tr>
            <tr><td>...</td></tr>
        </table>
<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
