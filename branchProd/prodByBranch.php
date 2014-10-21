<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";

    $branches = readObj("Branch", "bra_id", "-1");
?>
<script>
$(document).ready(function() {
     $('#example').dataTable({
        "iDisplayLength":5  
    });
//    $('#example').dataTable({
//        "iDisplayLength":5,
//        "dom": 'T<"clear">lfrtip',
//        "tableTools": {
//        "sSwfPath": "/resources/copy_csv_xls_pdf.swf",
//        "aButtons":  [
//                "copy",
//                "print",                
//                {
//                    "sExtends":    "collection",
//                    "sButtonText": "Save As",
//                    "aButtons":    [ "csv", "pdf", { "sExtends": "xls","sButtonText": "Excel","sFileName": "*.xls"}]
//                }
//            ]
//        }
//    });
});
</script>
<div class="prodBraContainer">
    <div class="lbl">Branch:
        <div class="ddl">
            <select id="user_bra_id">
                <?php
                    foreach($branches as $branch){
                        if($branch["prod_cat_id"] == $branch["bra_id"]){
                            echo "<option selected value=\"".$branch["bra_id"]."\">".$branch["bra_name"]."</option>";
                        }
                        else{
                            echo "<option value=\"".$branch["bra_id"]."\">".$branch["bra_name"]."</option>";
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    
    <table width="100%">
        <tr>
            <td><h3>Product Management</h3></td>       
        </tr>
    </table>

    <table id="example" class="display cell-border">
        <thead>
            <tr>
                <th>ID</th>
                <th>CATEGORY</th>
                <th>NAME</th>
                <th>Qty</th>
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
                    echo "<td>".$obj["prod_name"]."</td>";
                    echo "<td>".$obj["prod_qty"]."</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>CATEGORY</th>
                <th>NAME</th>
                <th>Qty</th>
            </tr>
        </tfoot>    
    </table>
    
</div>




<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>