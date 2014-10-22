<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";

getProdSession();
getCustSession();

if(isset($_POST["ord_in_date"])){
    $ord_in_date   = $_POST["ord_in_date"];
    $ord_in_cust_id = $_POST["ord_in_cust_id"];
    
    $ord_in_id = aeObj(
        "orderIn", 
        array(
            "ord_in_id"        =>"-1",
            "ord_in_bra_id"    => $_SESSION["user"]["user_bra_id"],
            "ord_in_cust_id"   =>$ord_in_cust_id,
            "ord_in_date"      =>$ord_in_date, 
            "ord_in_del_date"  =>"0000-00-00 00:00:00",
            "ord_in_status"    =>"1"
        )
    );
    header("location:add.php?ord_in_id=$ord_in_id");
    
}

if(isset($_POST["ord_in_det_prod_id"])){
    $ord_in_det_id         = "-1";
    $ord_in_det_ord_in_id = $_GET["ord_in_id"];
    $ord_in_det_prod_id    = $_POST["ord_in_det_prod_id"];
    $ord_in_det_qty        = $_POST["ord_in_det_qty"];
    
    $array = array(
        "ord_in_det_id"            => $ord_in_det_id,
        "ord_in_det_ord_in_id"    => $ord_in_det_ord_in_id,
        "ord_in_det_prod_id"       => $ord_in_det_prod_id,
        "ord_in_det_qty"           => $ord_in_det_qty
    );
    $ord_in_det_id = aeObj("OrderInDetail", $array);
    header("location:add.php?ord_in_id=$ord_in_det_ord_in_id");
}


if(!isset($_GET["ord_in_id"])){

?>
<script>
    $(document).ready(function(){
        $("#orderInForm").submit(function(){
            if($("#ord_in_cust_id").val() == " " || $("#ord_in_cust_id").val() == "" || isNaN($("#ord_in_cust_id").val()) ){
                alert("Please enter a valid customer name");
                $("#custInput").val("");
                $("#custInput").focus();
                return false;
            }
            else{
                return true;
            }
        });
        $("#custInput").blur(function(){
            var cust = $(this).val();
            $("#ord_in_cust_id").val(cust.split(" | ")[1]);
        }); 
    });
</script>
<br/>
<form action="add.php" method="post" id="orderInForm">
<table align="center">
    <tr>
        <td>Order Date</td>
        <td><input type="date" id="ord_in_date" name="ord_in_date" required tabindex="1"/></td>
        <td>Customer</td>
        <td>
            <input list="customers" id="custInput" required autocomplete="off"  tabindex="3"/>
            <datalist id="customers">
                <?php
                    $customers = $_SESSION["customers"];
                    foreach($customers as $cust){
                        echo "<option cust_id = \"".$cust["cust_id"]."\" value=\"".$cust["cust_name"]." | ".$cust["cust_id"]."\" />";
                    }
                ?>
            </datalist>
            <input type="hidden" id="ord_in_cust_id" name="ord_in_cust_id" required readonly style="width:45px;"/>
        </td>
        <td><input id="btnAdd" type="submit" class="myButton" value="Add Order In"  tabindex="4"/></td>
    </tr>
</table>
</form>
<?php
}
else{
    $ord_in_id = $_GET["ord_in_id"];
    $order = readObj("orderIn", "ord_in_id", $ord_in_id)[0];
    ?>
    <script>
        $(document).ready(function(){
            $("#orderInDetForm").submit(function(){
                if($("#ord_in_det_prod_id").val() == " " || $("#ord_in_det_prod_id").val() == "" || isNaN($("#ord_in_det_prod_id").val()) ){
                    alert("Please enter a valid product name");
                    $("#prodInput").val("");
                    $("#prodInput").focus();
                    return false;
                }
                else{
                    return true;
                }
            });
            $("#prodInput").blur(function(){
                var prod = $(this).val();
                $("#ord_in_det_prod_id").val(prod.split(" | ")[1]);
                $("#prod_up").val(prod.split(" | ")[2]);
            }); 
            $("#ord_in_det_qty").blur(function(){
                var qty = $("#ord_in_det_qty").val();
                var up = $("#prod_up").val();
                $("#ord_in_det_total").val(parseFloat(qty)*parseFloat(up));
            });
            $('#example').dataTable({
                "iDisplayLength":-1,
                "dom": 'T<"top">rt<"bottom"><"clear">',
                "tableTools": {
                "sSwfPath": "/resources/copy_csv_xls_pdf.swf",
                "aButtons":  [
                        "copy",
                        "print",
                
                {
                    "sExtends":    "collection",
                    "sButtonText": "Save As",
                    "aButtons":    [ "csv", "pdf", { "sExtends": "xls","sButtonText": "Excel","sFileName": "*.xls"}]
                }
            ]
        }
            });
        });        
    </script>
    <table align="center" width="100%"><h3>Sale Order</h3>
        <tr>
            <td width="33%"><b>Reference:</b> <?=$ord_in_id?></td>
            <td width="33%"><b>Order Date:</b> <?= substr($order["ord_in_date"],0,10);?></td>
            <td width="33%"><b>Customer:</b> 
            <?php
                $customers = $_SESSION["customers"];
                foreach($customers as $customer){
                    if($customer["cust_id"] == $order["ord_in_cust_id"]){
                        echo $customer["cust_name"];
                    }
                }
            ?>
            </td>
        </tr>
    </table>
    <hr/>
    <form id="orderInDetForm" method="post" action="add.php?ord_in_id=<?= $ord_in_id ?>">
    <table width="100%" align="center">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th></th>
        </tr>
        <tr>
            <td>
                <input type="hidden" name="ord_in_det_prod_id" id="ord_in_det_prod_id" />
                <input list="products" id="prodInput" required autocomplete="off"/>
                <datalist id="products">
                    <?php
                        $products = $_SESSION["products"];
                        foreach($products as $prod){
                            echo "<option prod_id = \"".$prod["prod_id"]."\" value=\"".$prod["prod_name"]." | ".$prod["prod_id"]." | ".$prod["prod_up"]."\" />";
                        }
                    ?>
                </datalist>                
            </td>
            <td><input type="text" name="prod_up" id="prod_up" readonly/></td>
            <td><input type="text" name="ord_in_det_qty" id="ord_in_det_qty"/></td>
            <td><input type="text" name="ord_in_det_total" id="ord_in_det_total" readonly/></td>
            <td><input type="submit" value="add" class="myButton"/></td>
        </tr>
    </table>
    </form>
    <hr/>
    <table id="example" class="border cell-border">
        <thead>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Delete</th>            
        </thead>
        <tbody>
            <?php
                $orderDetails = getOrderInDetailByOrdInId($ord_in_id);
                $ord_in_total=0;
                if($orderDetails != null){
                    $qty = 0; $up = 0;
                    foreach($orderDetails as $od){
                        echo "<tr>";
                        echo "<td>";
                        $products = $_SESSION["products"];
                        foreach($products as $product){
                            if($od["ord_in_det_prod_id"] == $product["prod_id"]){
                                echo $product["prod_name"];
                            }
                        }
                        echo "</td>";
                        echo "<td>";
                        
                        foreach($products as $product){
                            if($od["ord_in_det_prod_id"] == $product["prod_id"]){
                                echo $product["prod_up"]." USD";
                                $up = $product["prod_up"];
                            }
                        }
                        echo "</td>";
                        $qty = $od["ord_in_det_qty"];
                        echo "<td>$qty</td>";
                        $ord_in_det_total=($qty * $up);
                        $ord_in_total += $ord_in_det_total;
                        echo "<td>$ord_in_det_total USD</td>";
                        echo "<td><a href=\"DeleteOrderInDetail.php?ord_in_det_id=".$od["ord_in_det_id"]."&ord_in_id=".$od["ord_in_det_ord_in_id"]."\">Delete</a></td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
        <tfoot>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Delete</th>            
        </tfoot>        
    </table>
    <div align="right" style="font-weight: bold;">
        TOTAL PREVU <input type='text' id='ord_in_total' readonly value='<?=$ord_in_total?> USD'>
        <input type="button" value="Save" onclick= "window.location.href ='show.php'" class="myButton" />
    </div>
        
    <?php
}
?>

<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>