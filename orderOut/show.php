<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
getSupSession();
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
<table width="100%"><tr><td><h3>Purchases Orders</h3></td><td align="right"><input type="button" value="Create" class="myButton" onclick="javascript:window.location.href='add.php'"/></td></tr></table>
<table id="example" class="display cell-border">
    <thead>
        <tr>
            <th>Reference</th>
            <th>Supplier</th>
            <th>Status</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $suppliers = $_SESSION["suppliers"];
            $objs = readObj("OrderOut", "ord_out_id", "-1");
            foreach($objs as $obj){
                echo "<tr>";
                    echo "<td>".$obj["ord_out_id"]."</td>";
                    echo "<td>";
                    foreach($suppliers as $supplier){
                        if($supplier["sup_id"] == $obj["ord_out_sup_id"]){
                            echo $supplier["sup_name"];
                        }
                    }
                    echo "</td>";
                    echo "<td>".$obj["ord_out_status"]."</td>";
                    echo "<td>".$obj["ord_out_time_stamp"]."</td>";
                echo "<td><a href=\"add.php?ord_out_id=".$obj["ord_out_id"].""."\">View</a></td>";
                echo "<td><a href=\"delete.php?ord_out_id=".$obj["ord_out_id"]."\">Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
    <tfoot>
         <tr>
            <th>Reference</th>
            <th>Supplier</th>
            <th>Status</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </tfoot>    
</table>

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>