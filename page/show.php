<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<script>
$(document).ready(function() {
    var table = $('#example').dataTable({
        "iDisplayLength":5
    });
});
</script>
<div class="clear"></div>
<table width="100%"><tr><td><h3>Page Management</h3></td><td align="right"><input type="button" value="Create" class="myButton" onclick="javascript:window.location.href='add.php'"/></td></tr></table>
<table id="example" class="display cell-border">
    <thead>
        <tr>
            <th>ID</th>
            <th>Parent</th>
            <th>Name</th>
            <th>URL</th>
            <th>ACL</th>
            <th>In Menu</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $objs = getAllPages();
            foreach($objs as $obj){
                echo "<tr>";
                echo "<td>".$obj["page_id"]."</td>";
                if($obj["page_parent_id"] == "0"){
                    echo "<td>&nbsp;</td>"; 
                }
                else{
                    foreach ($objs as $subObj){
                        if($obj["page_parent_id"] == $subObj["page_id"]){
                            echo "<td>".$subObj["page_name"]."&nbsp;</td>";
                        }
                    }
                }
                echo "<td>".$obj["page_name"]."</td>";
                echo "<td>".$obj["page_url"]."</td>";
                echo "<td>".$obj["page_acl"]."</td>";
                echo "<td>".$obj["page_in_menu"]."</td>";
                echo "<td>".$obj["page_time_stamp"]."</td>";
                echo "<td><a href=\"edit.php?page_id=".$obj["page_id"].""."\">Edit</a></td>";
                echo "<td><a href=\"delete.php?page_id=".$obj["page_id"]."\">Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Parent</th>
            <th>Name</th>
            <th>URL</th>
            <th>ACL</th>
            <th>In Menu</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </tfoot>    
</table>

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
