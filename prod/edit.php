<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    if(!isset($_GET["prod_id"])){
        header("location:show.php");
    }
    
    $prod = readObj("Product", "prod_id", $_GET["prod_id"])[0];
    $category = readObj("Category", "cat_id", "-1");
    $supplier = readObj("Supplier", "sup_id", "-1");
?>
<script>
$(document).ready(function(){
    $("#btnRegister").click(function () {
        editProduct();
    });
    $("#registerForm").keypress(function (event) {
        if(event.which === 13){
            editProduct();
        }
    });
});
</script>
<form id="registerForm" >
    <div class="registerContainer">
        <h3>PRODUCT</h3>
        <div class="lbl">Category:
            <select class="input" id="prod_cat_id" value="<?= $prod['prod_cat_id']?>" >
            
            <?php
                foreach($category as $cat){
                    if($cat["cat_name"] == $prod["prod_cat_id"]){
                        echo "<option selected value=\"".$cat["cat_id"]."\" >".$cat["cat_name"]."</option>";
                    }
                    else{
                        echo "<option value=\"".$cat["cat_id"]."\">".$cat["cat_name"]."</option>";
                    }
                }                
            ?>
            </select>
            </div>
        <div class="lbl">SKU:
            <input type="text" class="input" id="prod_sku" value="<?= $prod['prod_sku']?>"/></div>
            
            <div class="lbl">UPC:
            <input type="text" class="input" id="prod_upc" value="<?= $prod['prod_upc']?>"/></div>

        <div class="lbl">Name:
            <input type="text" class="input" id="prod_name" value="<?= $prod['prod_name']?>"/></div>
            
        <div class="lbl">Description:
            <input type="text" class="input" id="prod_desc" value="<?= $prod['prod_desc']?>"/></div>

<!--        <div class="lbl">Quantity:
            <input type="text" class="input" id="prod_qty" /></div>-->

         
        <div class="lbl">Color:
            <input type="text" class="input" id="prod_color" value="<?= $prod['prod_color']?>"/></div>
            
        <div class="lbl">Size:
            <input type="text" class="input" id="prod_size" value="<?= $prod['prod_size']?>"/></div>
            
            <div class="lbl">Weight:
            <input type="text" class="input" id="prod_weight" value="<?= $prod['prod_weight']?>"/></div>
            
            <div class="lbl">Supplier:
            <select class="input" id="prod_sup_id" value="<?= $prod['prod_sup_id']?>" >
            <?php
                foreach($supplier as $sup){
                    if($sup["sup_name"] == $prod["prod_sup_id"]){
                        echo "<option selected value=\"".$sup["sup_id"]."\" >".$sup["sup_name"]."</option>";
                    }
                    else{
                        echo "<option value=\"".$sup["sup_id"]."\">".$sup["sup_name"]."</option>";
                    }
                }                
            ?>
            </select>
            </div>
            
            <div class="lbl">Price IN USD:
            <input type="text" class="input" id="prod_vend_id" value="<?= $prod['prod_vend_id']?>"/></div>
        
            <div class="lbl">Status:
                <select class="input" id="prod_status" value="<?= $prod['prod_status']?>" selected>
                    <option value="0">Regular</option>
                    <option value="1">Non stock item</option>
                </select>
            </div>
            
            <input id="btnRegister" class="btnRegister" type="button" name="submit" value="SAVE"  style="float:left;"/>    
            <input class="btnRegister" type="reset" value="RESET"   style="float:left;"/>
            <input class="btnRegister" type="button" value="CANCEL" onclick="javascript:window.location.href='show.php'" style="float:left;"/>
           
           
           
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
   </div>
    <input type="text" id="prod_id" value="<?=$_GET['prod_id']?>" style="display:none" />
</form>

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
