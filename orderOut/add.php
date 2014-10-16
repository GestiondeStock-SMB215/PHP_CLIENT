<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";

getProdSession();
getSupSession();

if(isset($_POST["ord_out_date"])){
    $ord_out_date   = $_POST["ord_out_date"];
    $ord_out_sup_id = $_POST["ord_out_sup_id"];
    
    $ord_out_id = aeObj(
        "orderOut", 
        array(
            "ord_out_id"        =>"-1",
            "ord_out_sup_id"    =>$ord_out_sup_id,
            "ord_out_date"      =>$ord_out_date, 
            "ord_out_del_date"  =>"0000-00-00 00:00:00",
            "ord_out_status"    =>"0"
        )
    );
    header("location:add.php?ord_out_id=$ord_out_id");
    
}

if(isset($_POST["ord_out_det_prod_id"])){
    $ord_out_det_id         = "-1";
    $ord_out_det_ord_out_id = $_GET["ord_out_id"];
    $ord_out_det_prod_id    = $_POST["ord_out_det_prod_id"];
    $ord_out_det_qty        = $_POST["ord_out_det_qty"];
    
    $array = array(
        "ord_out_det_id"            => $ord_out_det_id,
        "ord_out_det_ord_out_id"    => $ord_out_det_ord_out_id,
        "ord_out_det_prod_id"       => $ord_out_det_prod_id,
        "ord_out_det_qty"           => $ord_out_det_qty
    );
    $ord_out_det_id = aeObj("OrderOutDetail", $array);
    header("location:add.php?ord_out_id=$ord_out_det_ord_out_id");
}


if(!isset($_GET["ord_out_id"])){

?>
<script>
    $(document).ready(function(){
        $("#orderOutForm").submit(function(){
            if($("#ord_out_sup_id").val() == " " || $("#ord_out_sup_id").val() == "" || isNaN($("#ord_out_sup_id").val()) ){
                alert("Please enter a valid supplier name");
                $("#supInput").val("");
                $("#supInput").focus();
                return false;
            }
            else{
                return true;
            }
        });
        $("#supInput").blur(function(){
            var sup = $(this).val();
            $("#ord_out_sup_id").val(sup.split(" | ")[1]);
        }); 
    });
</script>
<br/>
<form action="add.php" method="post" id="orderOutForm">
<table align="center">
    <tr>
        <td>Order Date</td>
        <td><input type="date" id="ord_out_date" name="ord_out_date" required tabindex="1"/></td>
        <td>Supplier</td>
        <td>
            <input list="suppliers" id="supInput" required autocomplete="off"  tabindex="3"/>
            <datalist id="suppliers">
                <?php
                    $suppliers = $_SESSION["suppliers"];
                    foreach($suppliers as $sup){
                        echo "<option sup_id = \"".$sup["sup_id"]."\" value=\"".$sup["sup_name"]." | ".$sup["sup_id"]."\" />";
                    }
                ?>
            </datalist>
            <input type="hidden" id="ord_out_sup_id" name="ord_out_sup_id" required readonly style="width:45px;"/>
        </td>
        <td><input id="btnAdd" type="submit" class="myButton" value="Add Order Out"  tabindex="4"/></td>
    </tr>
</table>
</form>
<?php
}
else{
    $ord_out_id = $_GET["ord_out_id"];
    $order = readObj("orderOut", "ord_out_id", $ord_out_id)[0];
    ?>
    <script>
        $(document).ready(function(){
            $("#orderOutDetForm").submit(function(){
                if($("#ord_out_det_prod_id").val() == " " || $("#ord_out_det_prod_id").val() == "" || isNaN($("#ord_out_det_prod_id").val()) ){
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
                $("#ord_out_det_prod_id").val(prod.split(" | ")[1]);
                $("#prod_up").val(prod.split(" | ")[2]);
            }); 
            $("#ord_out_det_qty").blur(function(){
                var qty = $("#ord_out_det_qty").val();
                var up = $("#prod_up").val();
                $("#ord_out_det_total").val(parseFloat(qty)*parseFloat(up));
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
    <table align="center" width="100%"><h3>Purchase Order</h3>
        <tr>
            <td width="33%"><b>Reference:</b> <?=$ord_out_id?></td>
            <td width="33%"><b>Order Date:</b> <?=substr($order["ord_out_date"],0,10)?></td>
            <td width="33%"><b>Supplier:</b> 
            <?php
                $suppliers = $_SESSION["suppliers"];
                foreach($suppliers as $supplier){
                    if($supplier["sup_id"] == $order["ord_out_sup_id"]){
                        echo $supplier["sup_name"];
                    }
                }
            ?>
            </td>
        </tr>
    </table>
    <hr/>
    <form id="orderOutDetForm" method="post" action="add.php?ord_out_id=<?= $ord_out_id ?>">
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
                <input type="hidden" name="ord_out_det_prod_id" id="ord_out_det_prod_id" />
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
            <td><input type="text" name="ord_out_det_qty" id="ord_out_det_qty"/></td>
            <td><input type="text" name="ord_out_det_total" id="ord_out_det_total" readonly/></td>
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
                $orderDetails = getOrderOutDetailByOrdOutId($ord_out_id);
                $ord_out_total=0;
                if($orderDetails != null){
                    $qty = 0; $up = 0;
                    foreach($orderDetails as $od){
                        echo "<tr>";
                        echo "<td>";
                        $products = $_SESSION["products"];
                        foreach($products as $product){
                            if($od["ord_out_det_prod_id"] == $product["prod_id"]){
                                echo $product["prod_name"];
                            }
                        }
                        echo "</td>";
                        echo "<td>";
                        
                        foreach($products as $product){
                            if($od["ord_out_det_prod_id"] == $product["prod_id"]){
                                echo $product["prod_up"]." USD";
                                $up = $product["prod_up"];
                            }
                        }
                        echo "</td>";
                        $qty = $od["ord_out_det_qty"];
                        echo "<td>$qty</td>";
                        $ord_out_det_total=($qty * $up);
                        $ord_out_total += $ord_out_det_total;
                        echo "<td>$ord_out_det_total USD</td>";
                        echo "<td><a href=\"DeleteOrderOutDetail.php?ord_out_det_id=".$od["ord_out_det_id"]."&ord_out_id=".$od["ord_out_det_ord_out_id"]."\">Delete</a></td>";
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
        TOTAL PREVU <input type='text' id='ord_out_total' readonly value='<?=$ord_out_total?> USD'>
        <input type="button" value="Save" onclick= "window.location.href ='show.php'" class="myButton" />
    </div>
    <?php
}
?>

<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>