<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
getProdSession();
getBranchSession();

if(isset($_POST["trans_send_date"])){
    $trans_send_date   = $_POST["trans_send_date"];
    $trans_src_bra_id = $_POST["trans_src_bra_id"];
    $trans_dest_bra_id = $_POST["trans_dest_bra_id"];
    
    $trans_id = aeObj(
        "transfert", 
        array(
            "trans_id"            =>"-1",
            "trans_src_bra_id"    =>$trans_src_bra_id,
            "trans_dest_bra_id"   =>$trans_dest_bra_id, 
            "trans_send_date"     =>$trans_send_date,
            "trans_del_date"      =>"0000-00-00 00:00:00",
            "trans_status"        =>"0"
        )
    );
    header("location:add.php?trans_id=$trans_id");
    
}

if(isset($_POST["trans_det_id"])){
    $trans_det_id         = "-1";
    $trans_det_trans_id   = $_GET["trans_id"];
    $trans_det_prod_id    = $_POST["trans_det_prod_id"];
    $trans_det_qty        = $_POST["trans_det_qty"];
    
    $array = array(
        "trans_det_id"            => $trans_det_id,
        "trans_det_trans_id"      => $trans_det_trans_id,
        "trans_det_prod_id"       => $trans_det_prod_id,
        "trans_det_qty"           => $trans_det_qty
    );
    $trans_det_id = aeObj("TransDetail", $array);
    header("location:add.php?trans_id=$trans_det_trans_id");
}

if(!isset($_GET["trans_id"])){

?>
<script>
    $(document).ready(function(){
        $("#transForm").submit(function(){
            if($("#trans_src_bra_id").val() == " " || $("#trans_src_bra_id").val() == "" || isNaN($("#trans_src_bra_id").val()) ){
                alert("Please enter a valid source branch");
                $("#srcInput").val("");
                $("#srcInput").focus();
                return false;
            }
            else{
                return true;
            }
            
             if($("#trans_dest_bra_id").val() == " " || $("#trans_dest_bra_id").val() == "" || isNaN($("#trans_dest_bra_id").val()) ){
                alert("Please enter a valid destination branch");
                $("#destInput").val("");
                $("#destInput").focus();
                return false;
            }
            else{
                return true;
            }
        });
        $("#srcInput").blur(function(){
            var src = $(this).val();
            $("#trans_src_bra_id").val(src.split(" | ")[1]);
        }); 
        
        $("#destInput").blur(function(){
            var src = $(this).val();
            $("#trans_dest_bra_id").val(src.split(" | ")[1]);
        }); 
    });
</script>
<br/>
<form action="add.php" method="post" id="transForm">
<table align="center">
    <tr>
        <td>Transfer Date</td>
        <td><input type="date" id="trans_send_date" name="trans_send_date" required tabindex="1"/></td>
        <td>Branch Source</td>
        <td>
            <input list="branches" id="srcInput" required autocomplete="off"  tabindex="3"/>
            <datalist id="branches">
                <?php
                    $branches = $_SESSION["branches"];
                    foreach($branches as $src){
                        echo "<option bra_id = \"".$src["bra_id"]."\" value=\"".$src["bra_name"]." | ".$src["bra_id"]."\" />";
                    }
                ?>
            </datalist>
            <input type="hidden" id="trans_src_bra_id" name="trans_src_bra_id" required readonly style="width:45px;"/>
        </td>
        
        <td>Branch Destination</td>
        <td>
            <input list="branches" id="destInput" required autocomplete="off"  tabindex="3"/>
            <datalist id="branches">
                <?php
                    $branches = $_SESSION["branches"];
                    foreach($branches as $dest){
                        echo "<option bra_id = \"".$dest["bra_id"]."\" value=\"".$dest["bra_name"]." | ".$dest["bra_id"]."\" />";
                    }
                ?>
            </datalist>
            <input type="hidden" id="trans_dest_bra_id" name="trans_dest_bra_id" required readonly style="width:45px;"/>
        </td>
        
        <td><input id="btnAdd" type="submit" class="myButton" value="Add Transfert"  tabindex="4"/></td>
    </tr>
</table>
</form>
<?php
}
else{
    $trans_id = $_GET["trans_id"];
    $transfert = readObj("Transfert", "trans_id", $trans_id)[0];
    ?>
    <script>
        $(document).ready(function(){
            $("#transDetForm").submit(function(){
                if($("#trans_det_prod_id").val() == " " || $("#trans_det_prod_id").val() == "" || isNaN($("#trans_det_prod_id").val()) ){
                    alert("Please enter a valid product name");
                    $("#prodInput").val("");
                    $("#prodInput").focus();
                    return false;
                }
                else{
                    return true;
                }
            });
            $("#prodInput").blur(function(){
                var prod = $(this).val();
                $("#trans_det_prod_id").val(prod.split(" | ")[1]);
                
            }); 
            $("#trans_det_qty").blur(function(){
                var qty  = $("#trans_det_qty").val();
                var desc = $("#prod_desc").val();
            });
            $('#example').dataTable({
                "iDisplayLength":-1,
                "dom": '<"top"f>rt<"bottom"><"clear">'
            });
        });        
    </script>
    <table align="center" width="100%"><h3>Transfert</h3>
        <tr>
            <td width="25%"><b>Reference:</b> <?=$trans_id?></td>
            <td width="25%"><b>Date:</b> <?=$transfert["trans_send_date"]?></td>
            <td width="25%"><b>FROM:</b> 
            <?php
                $branches = $_SESSION["branches"];
                foreach($branches as $src){
                    if($src["bra_id"] == $transfert["trans_src_bra_id"]){
                        echo $src["bra_name"];
                    }
                }
            ?>
            </td>
            <td width="25%"><b>TO:</b> 
            <?php
                $branches = $_SESSION["branches"];
                foreach($branches as $dest){
                    if($dest["bra_id"] == $transfert["trans_dest_bra_id"]){
                        echo $dest["bra_name"];
                    }
                }
            ?>
            </td>
        </tr>
    </table>
    <hr/>
    <form id="transDetForm" method="post" action="add.php?trans_id=<?= $trans_id ?>">
    <table width="100%" align="center">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            
        </tr>
        <tr>
            <td>
                <input type="hidden" name="trans_det_prod_id" id="trans_det_prod_id" />
                <input list="products" id="prodInput" required autocomplete="off"/>
                <datalist id="products">
                    <?php
                        $products = $_SESSION["products"];
                        foreach($products as $prod){
                            echo "<option prod_id = \"".$prod["prod_id"]."\" value=\"".$prod["prod_name"]." | ".$prod["prod_id"]." \" />";
                        }
                    ?>
                </datalist>                
            </td>
            
            <td><input type="text" name="trans_det_qty" id="trans_det_qty"/></td>
            <td><input type="submit" value="add" class="myButton"/></td>
        </tr>
    </table>
    </form>
    <hr/>
    <table id="example" class="border cell-border">
        <thead>
            <th>Product</th>
            <th>Quantity</th>
            <th>Edit</th>
            <th>Delete</th>            
        </thead>
        <tbody>
            <?php
                $transDetails = getTransDetailByTransId($trans_id);
                $trans_total=0;
                if($transDetails != null){
                    //$qty = 0; $up = 0;
                    foreach($transDetails as $trans){
                        echo "<tr>";
                        echo "<td>";
                        $products = $_SESSION["products"];
                        foreach($products as $product){
                            if($trans["trans_det_prod_id"] == $product["prod_id"]){
                                echo $product["prod_name"];
                            }
                        }
                        echo "</td>";
                        echo "</td>";
                        $qty = $trans["trans_det_qty"];
                        echo "<td>$qty</td>";
                       
                        echo "<td><a href=\"editTranfertDetail.php?trans_det_id=".$trans["trans_det_id"]."\">Edit</a></td>";
                        echo "<td><a href=\"DeleteTransfertDetail.php?trans_det_id=".$trans["trans_det_id"]."\">Delete</a></td>";
                        echo "</tr>";
                    }
                }
                
            ?>
        </tbody>
        <tfoot>
            <th>Product</th>
            <th>Quantity</th>
            <th>Edit</th>
            <th>Delete</th>            
        </tfoot>        
    </table>
    <div align="right" style="font-weight: bold;">
        TOTAL <input type='text' id='trans_total' readonly value='<?=$trans_total?>'>
        <input type="button" value="Save" onclick= "window.location.href ='show.php'" class="myButton" />
    </div>
    <?php
}
?>

<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>