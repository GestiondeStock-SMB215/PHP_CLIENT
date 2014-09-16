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
<table width="100%"><tr><td><h3>Product Management</h3></td><td align="right"><input type="button" value="Create" class="myButton" onclick="javascript:window.location.href='add.php'"/></td></tr></table>
<table id="example" class="display cell-border">
    <thead>
        <tr>
            <th>ID</th>
            <th>CATEGORY</th>
            <th>SKU</th>
            <th>UPC</th>
            <th>NAME</th>
            <th>Qty</th>
            <th>Color</th>
            <th>Size</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $objs = readObj("Product", "prod_id", "-1");
            $cats = readObj("Category", "cat_id", "-1");
            foreach($objs as $obj){
                echo "<tr title=\"".$obj["prod_desc"]."\">";
                echo "<td>".$obj["prod_id"]."</td>";
                foreach ($cats as $cat){
                    if($cat["cat_id"] == $obj["prod_cat_id"]){
                        echo "<td>".$cat["cat_name"]."</td>";
                    }
                }
                echo "<td>".$obj["prod_sku"]."</td>";
                echo "<td>".$obj["prod_upc"]."</td>";
                echo "<td>".$obj["prod_name"]."</td>";
                echo "<td>".$obj["prod_qty"]*$obj["prod_qty_per_unit"]."</td>";
                echo "<td>".$obj["prod_color"]."</td>";
                echo "<td>".$obj["prod_size"]."</td>";
                echo "<td>".$obj["prod_time_stamp"]."</td>";
                echo "<td><a href=\"edit.php?id=".$obj["prod_id"].""."\">Edit</a></td>";
                echo "<td><a href=\"delete.php?id=".$obj["prod_id"]."\">Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>CATEGORY</th>
            <th>SKU</th>
            <th>UPC</th>
            <th>NAME</th>
            <th>Qty</th>
            <th>Color</th>
            <th>Size</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </tfoot>    
</table>

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>