<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<h3><?php getBranchSession();

for($i=0;$i<count($_SESSION['branches']);$i++){
    if($_GET['bra_id']== $_SESSION['branches'][$i]["bra_id"]){
        echo $_SESSION['branches'][$i]["bra_name"];
        break;
    }
}

        
        ?></h3>
    <div>
        <?php $res=readProdBra();?>
    </div>
        <table style="border:solid 1px black;">
            
            <?php for($i=0;$i<count($res);$i++){
             
                ?>
            <tr>
                  <td style="border:solid 1px black;"><?php echo $res[$i]['prod_sku'];?></td>
                  <td style="border:solid 1px black;"><?php echo $res[$i]['prod_name'];?></td>
                  <td style="border:solid 1px black;"><?php echo $res[$i]['prod_desc'];?></td>
               </tr>
               <?php } ?>
        </table>
<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
