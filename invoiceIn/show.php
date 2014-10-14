<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
getCustSession();
?>
<script>
$(document).ready(function() {
    $('#example').dataTable({
        "iDisplayLength":5,
        "dom": 'T<"clear">lfrtip',
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
<div class="clear"></div>
<table width="100%"><tr><td><h3>Invoices In</h3></td><td align="right"><input type="button" value="Create" class="myButton" onclick="javascript:window.location.href='add.php'"/></td></tr></table>
<table id="example" class="display cell-border">
    <thead>
        <tr>
            <th>Order Reference</th>
            <th>Customers</th>
            <th>Date</th>
            <th>Total</th>
            <th>Status</th>
            <th>Time Stamp</th>
            <th>View</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $customers = $_SESSION["customers"];
            $objs = readObj("InvoiceIn", "inv_in_id", "-1");
            foreach($objs as $obj){
                echo "<tr>";
                    echo "<td>".$obj["inv_in_ord_in_id"]."</td>";
                    echo "<td>";
                    foreach($customers as $customer){
                        if($customer["cust_id"] == $obj["inv_in_cust_id"]){
                            echo $customer["cust_name"];
                        }
                    }
                    echo "</td>";
                    echo "<td>".$obj["inv_in_date"]."</td>";
                    echo "<td>".number_format($obj["inv_in_total_due"],2)." USD</td>";
                    echo "<td>".$obj["inv_in_status"]."</td>";
                    echo "<td>".$obj["inv_in_time_stamp"]."</td>";
                echo "<td><a href=\"add.php?ord_in_id=".$obj["inv_in_id"].""."\">View</a></td>";
                echo "<td><a href=\"delete.php?ord_in_id=".$obj["inv_in_id"]."\">Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
    <tfoot>
         <tr>
            <th>Order Reference</th>
            <th>Customers</th>
            <th>Date</th>
            <th>Total</th>
            <th>Status</th>
            <th>Time Stamp</th>
            <th>View</th>
            <th>Delete</th>
        </tr>
    </tfoot>    
</table>

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>