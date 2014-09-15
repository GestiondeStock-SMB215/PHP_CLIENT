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
<table width="100%"><tr><td><h3>Category Management</h3></td><td align="right"><input type="button" value="Create" class="myButton" onclick="javascript:window.location.href='add.php'"/></td></tr></table>
<table id="example" class="display cell-border">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>DESCRIPTION</th>
            <th>PIC</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $objs = getCategories();
            
            foreach($objs as $obj){
                echo "<tr>";
                    echo "<td>".$obj["cat_id"]."</td>";
                    echo "<td>".$obj["cat_name"]."</td>";
                    echo "<td>".$obj["cat_desc"]."</td>";
                    echo "<td>".$obj["cat_pic"]."</td>";
                    echo "<td>".$obj["cat_time_stamp"]."</td>";
                echo "<td><a href=\"edit.php?cat_id=".$obj["cat_id"].""."\">Edit</a></td>";
                echo "<td><a href=\"delete.php?cat_id=".$obj["cat_id"]."\">Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>DESCRIPTION</th>
            <th>PIC</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </tfoot>    
</table>

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
