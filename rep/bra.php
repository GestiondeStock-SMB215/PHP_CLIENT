<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
    <h3>
        <?php 
            getBranchSession();
            for($i=0;$i<count($_SESSION['branches']);$i++){
                if($_GET['bra_id']== $_SESSION['branches'][$i]["bra_id"]){
                    echo $_SESSION['branches'][$i]["bra_name"];
                    break;
                }
            }
        ?>
    </h3>
    <div>
        <?php $objs = readProdBra();?>
    </div>
        <table style="border:solid 1px black;" >
            <tr>
                <td style="border:solid 1px black;padding:0 10px;">Product SKU</td>
                <td style="border:solid 1px black;padding:0 10px;">Name</td>
                <td style="border:solid 1px black;padding:0 10px;">Description</td>
                <td style="border:solid 1px black;padding:0 10px;">Quantity</td>
            </tr>
            <?php
                getProdSession();
                $products = $_SESSION["products"];
                foreach($objs as $obj){
                    echo "<tr>";
                    foreach ($products as $product){
                        if($product["prod_id"] == $obj["pb_prod_id"]){
                            echo "<td style=\"border:solid 1px black;padding:0 10px;\">".$product["prod_sku"]."</td>";
                            echo "<td style=\"border:solid 1px black;padding:0 10px;\">".$product["prod_name"]."</td>";
                            echo "<td style=\"border:solid 1px black;padding:0 10px;\">".$product["prod_desc"]."</td>";
                        }
                    }
                    echo "<td style=\"border:solid 1px black;padding:0 10px;\">".$obj["pb_qty"]."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
