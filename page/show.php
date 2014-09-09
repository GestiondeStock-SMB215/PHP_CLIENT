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
                echo "<td>".getPageName($obj["page_parent_id"])."</td>";
                echo "<td>".$obj["page_name"]."</td>";
                echo "<td>".$obj["page_url"]."</td>";
                echo "<td>".$obj["page_acl"]."</td>";
                echo "<td>".$obj["page_in_menu"]."</td>";
                echo "<td>".$obj["page_time_stamp"]."</td>";
                echo "<td><a href=\"edit.php?page_id=".$page["page_id"].""."\">Edit</a></td>";
                echo "<td><a href=\"delete.php?page_id=".$page["page_id"]."\">Delete</a></td>";
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
        </tr>
    </tfoot>    
</table>

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>