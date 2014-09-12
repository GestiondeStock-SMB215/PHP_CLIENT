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
<table width="100%"><tr><td><h3>Supplier Management</h3></td><td align="right"><input type="button" value="Create" class="myButton" onclick="javascript:window.location.href='add.php'"/></td></tr></table>
<table id="example" class="display cell-border">
    <thead>
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Supplier Name</th>
            <th>City</th>
            <th>Country</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $objs = getSuppliers(null);
            $countries = getCountries();
            
            foreach($objs as $obj){
                echo "<tr>";
                    echo "<td>".$obj["sup_id"]."</td>";
                    echo "<td>".$obj["sup_comp"]."</td>";
                    echo "<td>".$obj["sup_name"]."</td>";
                     echo "<td>".$obj["sup_city"]."</td>";
                    foreach ($countries as $country){
                        if($country["cnt_id"] == $obj["sup_cnt_id"]){
                            echo "<td>".$country["cnt_nicename"]."</td>";
                        }
                    }
                   
                    echo "<td>".$obj["sup_time_stamp"]."</td>";
                echo "<td><a href=\"edit.php?sup_id=".$obj["cust_id"].""."\">Edit</a></td>";
                echo "<td><a href=\"delete.php?sup_id=".$obj["cust_id"]."\">Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Supplier Name</th>
            <th>City</th>
            <th>Country</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </tfoot>    
</table>

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>