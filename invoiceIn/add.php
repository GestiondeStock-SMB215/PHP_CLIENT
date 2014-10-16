<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
if(!isset($_GET["ord_in_id"])){
    header("location:show.php");
}
getProdSession();
getCustSession();

?>
<script>
$(document).ready(function() {
    $('#example').dataTable({
        "iDisplayLength":5
    });
});
</script>
<table id="example" class="display cell-border">
    <thead>
    <tr>
        <th>Invoice Ref</th>
        <th>Invoice Customer</th>
        <th>Date</th>
        <th>Total Due</th>
        <th>View</th>
    </tr>
    </thead>
    <tbody>
<?php
$inv_ins = getInvInByOrdIn($_GET["ord_in_id"]);
foreach($inv_ins as $inv_in){
    echo "<tr>";
    echo "<td align=\"center\">".$inv_in["inv_in_id"]."</td>";
    echo "<td align=\"center\">";
    foreach($_SESSION["customers"] as $cust){
        if($cust["cust_id"] == $inv_in["inv_in_cust_id"]){
            echo $cust["cust_name"];
        }
    }
    echo "</td>";
    echo "<td align=\"center\">".substr($inv_in["inv_in_date"], 0, 10)."</td>";
    echo "<td align=\"center\">".number_format($inv_in["inv_in_total_due"], 2)." USD</td>";
    echo "<td align=\"center\"><a href=\"viewInvIn.php?inv_in_id=".$inv_in["inv_in_id"]."\" >View Details</a></td>";
    echo "</tr>";
}
?>
    </tbody>
    <tfoot>
    <tr>
        <th>Invoice Ref</th>
        <th>Invoice Customer</th>
        <th>Date</th>
        <th>Total Due</th>
        <th>View</th>
    </tr>
    </tfoot>
</table>
<hr />

<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>