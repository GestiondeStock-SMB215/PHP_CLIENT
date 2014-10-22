<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
getProdSession();
if(!isset($_GET["inv_in_id"])){
    header("location:show.php");
}
$inv_in_id = $_GET["inv_in_id"];
?>
<script>
$(document).ready(function() {
    $('#example0').dataTable({
        "iDisplayLength":5
    });
});
</script>
<table id="example0" class="display cell-border">
    <thead>
        <tr>
            <th>Sales Invoice Reference</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total</th>
            <th>Discount</th>
            <th>Total Due</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $products = $_SESSION["products"];
            global $wsdl;
            $objs = getInvoiceInDetail($inv_in_id);
            foreach($objs as $obj){
                echo "<tr>";
                    echo "<td align=\"center\">".$obj["inv_in_det_inv_id"]."</td>";
                    echo "<td align=\"center\">";
                    foreach($products as $product){
                        if($product["prod_id"] == $obj["inv_in_det_prod_id"]){
                            echo $product["prod_name"];
                        }
                    }
                    echo "</td>";
                    echo "<td align=\"center\">".number_format($obj["inv_in_det_qty"],2)."</td>";
                    echo "<td align=\"center\">".number_format($obj["inv_in_det_up"],2)." USD</td>";
                    echo "<td align=\"center\">".number_format($obj["inv_in_det_total"],2)." USD</td>";
                    echo "<td align=\"center\">".number_format($obj["inv_in_det_disc"],2)." %</td>";
                    echo "<td align=\"center\">".number_format($obj["inv_in_det_total_due"],2)." USD</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
    <tfoot>
         <tr>
            <th>Sales Invoice Reference</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total</th>
            <th>Discount</th>
            <th>Total Due</th>
        </tr>
    </tfoot>    
</table>
<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
