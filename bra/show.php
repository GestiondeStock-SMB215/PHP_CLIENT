<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<script>
$(document).ready(function() {
    $('#example').dataTable({
        "iDisplayLength":5,
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
        "sSwfPath": "/resources/copy_csv_xls_pdf.swf",
        "aButtons":  [
                "copy",
                "print",
                
                {
                    "sExtends":    "collection",
                    "sButtonText": "Save As",
                    "aButtons":    [ "csv", "pdf", { "sExtends": "xls","sButtonText": "Excel","sFileName": "*.xls"}]
                }
            ]
        }
    });
});
</script>
<div class="clear"></div>
<table width="100%"><tr><td><h3>Branch Management</h3></td><td align="right"><input type="button" value="Create" class="myButton" onclick="javascript:window.location.href='add.php'"/></td></tr></table>
<table id="example" class="display cell-border">
    <thead>
        <tr>
            <th>ID</th>
            <th>Branch Name</th>
            <th>Country</th>
            <th>City</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $objs = readObj("Branch", "bra_id", "-1");
            $countries = readObj("Country", "cnt_id", "-1");
            
            foreach($objs as $obj){
                echo "<tr>";
                    echo "<td>".$obj["bra_id"]."</td>";
                    echo "<td>".$obj["bra_name"]."</td>";
                    foreach ($countries as $country){
                        if($country["cnt_id"] == $obj["bra_cnt_id"]){
                            echo "<td>".$country["cnt_nicename"]."</td>";
                        }
                    }
                    echo "<td>".$obj["bra_city"]."</td>";
                    echo "<td>".$obj["bra_time_stamp"]."</td>";
                echo "<td><a href=\"edit.php?bra_id=".$obj["bra_id"].""."\">Edit</a></td>";
                echo "<td><a href=\"delete.php?bra_id=".$obj["bra_id"]."\">Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Branch Name</th>
            <th>Country</th>
            <th>City</th>
            <th>Time Stamp</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </tfoot>    
</table>

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>