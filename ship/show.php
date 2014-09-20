<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<script>
$(document).ready(function() {
    $('#example').dataTable({
        "iDisplayLength":5  
    });
});
</script>
<div class="clear"></div>
<table width="100%"><tr><td><h3>Shipper Management</h3></td><td align="right"><input type="button" value="Create" class="myButton" onclick="javascript:window.location.href='add.php'"/></td></tr></table>
<table id="example" class="display cell-border">
    <thead>
        <tr>
            <th>ID</th>
            <th>Shipper Name</th>
            <th>Type</th>
            <th>Tel</th>
            <th>Email</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $objs = readObj("Shipper", "ship_id", "-1");
            
            foreach($objs as $obj){
                echo "<tr>";
                    echo "<td>".$obj["ship_id"]."</td>";
                    echo "<td>".$obj["ship_name"]."</td>";
                    echo "<td>".$obj["ship_type"]."</td>";
                    echo "<td>".$obj["ship_tel_1"]."</td>";
                    echo "<td>".$obj["ship_email"]."</td>";
                    echo "<td>".$obj["ship_time_stamp"]."</td>";
                echo "<td><a href=\"edit.php?ship_id=".$obj["ship_id"].""."\">Edit</a></td>";
                echo "<td><a href=\"delete.php?ship_id=".$obj["ship_id"]."\">Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Shipper Name</th>
            <th>Type</th>
            <th>Tel</th>
            <th>Email</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </tfoot>    
</table>

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>