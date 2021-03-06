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
<table width="100%"><tr><td><h3>User Management</h3></td><td align="right"><input type="button" value="Create" class="myButton" onclick="javascript:window.location.href='add.php'"/></td></tr></table>
<table id="example" class="display cell-border">
    <thead>
        <tr>
            <th>ID</th>
            <th>Role</th>
            <th>Branch</th>
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
            $objs = readObj("User", "user_id", "-1");
            $roles = readObj("Role", "role_id", "-1");
            $branches = readObj("Branch", "bra_id", "-1");

            foreach($objs as $obj){
                echo "<tr>";
                echo "<td>".$obj["user_id"]."</td>";
                foreach ($roles as $role){
                    if($role["role_id"] == $obj["user_role_id"]){
                        echo "<td>".$role["role_name"]."</td>";
                    }
                }
                foreach ($branches as $branch){
                    if($branch["bra_id"] == $obj["user_bra_id"]){
                        echo "<td>".$branch["bra_name"]."</td>";
                    }
                }
                echo "<td>".$obj["user_name"]."</td>";
                echo "<td>".$obj["user_username"]."</td>";
                echo "<td>".$obj["user_email"]."</td>";
                echo "<td>".$obj["user_last_login"]."</td>";
                echo "<td>".$obj["user_status"]."</td>";
                echo "<td>".$obj["user_time_stamp"]."</td>";
                echo "<td><a href=\"edit.php?user_id=".$obj["user_id"].""."\">Edit</a></td>";
                echo "<td><a href=\"delete.php?user_id=".$obj["user_id"]."\">Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Role</th>
            <th>Branch</th>
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