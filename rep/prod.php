<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>

<script>
    $(document).ready(function(){
        var url = document.URL;
        var getSku = url.split('prod_sku=');
        var prod_sku = getSku[1];

       
    });
</script>
<?php getProdSession();
 getBranchSession();
$res= getProdIdBySku();
$pb_bra=  FindProdInBra($res);

for($i=0;$i<count($_SESSION['products']);$i++){
    if($res == $_SESSION['products'][$i]["prod_id"]){
        //echo $_SESSION['products'][$i]["prod_name"];
        break;
    }
}

?>

<div class="searchByProduct">
    <div style="height:40px;font-size:20px;margin-top:20px;">Product Search  :  <?php echo $_SESSION['products'][$i]["prod_name"];?></div>
    <div class="clear"></div>
    <table style="border:solid 1px black;">
        <tr>
            <th style="padding: 0 10px;border:solid 1px black;">Branch Name</th>
            <th style="padding: 0 10px;border:solid 1px black;">Quantity</th>            
        </tr>
         <?php
         for($i=0;$i<count($pb_bra);$i++){?>
        <tr>
            <td style="padding: 0 10px;border:solid 1px black;">
            <?php
            for($j=0;$j<count($_SESSION['branches']);$j++){
            if($pb_bra[$i]['pb_bra_id']== $_SESSION['branches'][$j]["bra_id"]){
                echo $_SESSION['branches'][$j]["bra_name"];
                break;
            }
}
             ?>
            </td>
            <td style="padding: 0 10px;border:solid 1px black;"><?php echo $pb_bra[$i]['pb_qty']?></td>
        </tr>
         <?php } ?>
    </table>
</div>

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
