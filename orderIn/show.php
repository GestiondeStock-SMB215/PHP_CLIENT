<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
getCustSession();
?>
<script>
$(document).ready(function() {
    $('#example').dataTable({
        "iDisplayLength":5  
    });
});
</script>
<div class="clear"></div>
<table width="100%"><tr><td><h3>Purchases Orders</h3></td><td align="right"><input type="button" value="Create" class="myButton" onclick="javascript:window.location.href='add.php'"/></td></tr></table>
<table id="example" class="display cell-border">
    <thead>
        <tr>
            <th>Reference</th>
            <th>Customers</th>
            <th>Status</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $customers = $_SESSION["customers"];
            $objs = readObj("OrderIn", "ord_in_id", "-1");
            foreach($objs as $obj){
                echo "<tr>";
                    echo "<td>".$obj["ord_in_id"]."</td>";
                    echo "<td>";
                    foreach($customers as $customer){
                        if($customer["cust_id"] == $obj["ord_in_cust_id"]){
                            echo $cust["cust_name"];
                        }
                    }
                    echo "</td>";
                    echo "<td>".$obj["ord_in_status"]."</td>";
                    echo "<td>".$obj["ord_in_time_stamp"]."</td>";
                echo "<td><a href=\"edit.php?ord_in_id=".$obj["ord_in_id"].""."\">Edit</a></td>";
                echo "<td><a href=\"delete.php?ord_in_id=".$obj["ord_in_id"]."\">Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
    <tfoot>
         <tr>
            <th>Reference</th>
            <th>Customer</th>
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