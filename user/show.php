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
            <th>Role</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Last Login</th>
            <th>Status</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $objs = getAllUsers();
            foreach($objs as $obj){
                echo "<tr>";
                echo "<td>".$obj["user_id"]."</td>";
                echo "<td>".getRoleName($obj["user_role_id"])."</td>";
                echo "<td>".$obj["user_name"]."</td>";
                echo "<td>".$obj["user_username"]."</td>";
                echo "<td>".$obj["user_email"]."</td>";
                echo "<td>".$obj["user_last_login"]."</td>";
                echo "<td>".$obj["user_status"]."</td>";
                echo "<td>".$obj["user_time_stamp"]."</td>";
                echo "<td><a href=\"edit.php?id=".$obj["user_id"].""."\">Edit</a></td>";
                echo "<td><a href=\"delete.php?id=".$obj["user_id"]."\">Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Role</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Last Login</th>
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