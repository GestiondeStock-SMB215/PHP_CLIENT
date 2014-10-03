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
<table width="100%"><tr><td><h3>Transfert</h3></td><td align="right"><input type="button" value="Create" class="myButton" onclick="javascript:window.location.href='add.php'"/></td></tr></table>
<table id="example" class="display cell-border">
    <thead>
        <tr>
            <th>ID</th>
            <th>Source Branch</th>
            <th>Destination Branch</th>
            <th>Status</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $objs = readObj("Transfert", "trans_id", "-1");
            $bras = readObj("branch", "bra_id", "-1");
            foreach($objs as $obj){
                echo "<tr>";
                    echo "<td>".$obj["trans_id"]."</td>";
                    echo "<td>";
                    foreach($bras as $bra){
                        if($bra["bra_id"] == $obj["trans_src_bra_id"]){echo $bra["bra_name"];}
                    }
                    echo "</td>";
                    echo "<td>";
                    foreach($bras as $bra){
                        if($bra["bra_id"] == $obj["trans_dest_bra_id"]){echo $bra["bra_name"];}
                    }
                    echo "</td>";
                    echo "<td>".$obj["trans_status"]."</td>";
                    echo "<td>".$obj["trans_time_stamp"]."</td>";
                echo "<td><a href=\"edit.php?trans_id=".$obj["trans_id"].""."\">Edit</a></td>";
                echo "<td><a href=\"delete.php?trans_id=".$obj["trans_id"]."\">Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Source Branch</th>
            <th>Destination Branch</th>
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