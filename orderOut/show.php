<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
getSupSession();
?>
<script>
$(document).ready(function() {
    $('#example').dataTable({
        "iDisplayLength":5  
    });
});
</script>
<div class="clear"></div>
<table width="100%"><tr><td><h3>Sales Orders</h3></td><td align="right"><input type="button" value="Create" class="myButton" onclick="javascript:window.location.href='add.php'"/></td></tr></table>
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
                echo "<td><a href=\"edit.php?ord_out_id=".$obj["ord_out_id"].""."\">Edit</a></td>";
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