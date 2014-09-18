<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    if(!isset($_GET["prod_id"])){
        header("location:show.php");
    }
    
    $prod = readObj("Prodcut", "prod_id", $_GET["prod_id"])[0];
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
            <select class="input" id="prod_cat_id">
            <option value="">Please choose</option>
            <?php
                foreach($cat as $item){
                    if($item["cat_name"] == ""){
                        echo "<option value=\"".$item["cat_id"]."\" selected>".$item["cat_name"]."</option>";
                    }
                    else{
                        echo "<option value=\"".$item["cat_id"]."\">".$item["cat_name"]."</option>";
                    }
                }                
            ?>
            </select>
            </div>
        <div class="lbl">SKU:
            <input type="text" class="input" id="prod_sku" /></div>
            
            <div class="lbl">UPC:
            <input type="text" class="input" id="prod_upc" /></div>

        <div class="lbl">Name:
            <input type="text" class="input" id="prod_name" /></div>
            
        <div class="lbl">Description:
            <input type="text" class="input" id="prod_desc" /></div>

        <div class="lbl">Quantity:
            <input type="text" class="input" id="prod_qty" /></div>

        <div class="lbl">Unit
            <input type="text" class="input" id="prod_qty_per_unit" /></div>
         
        <div class="lbl">Color:
            <input type="text" class="input" id="prod_color" /></div>
            
        <div class="lbl">Size:
            <input type="text" class="input" id="prod_size" /></div>
            
            <div class="lbl">Weight:
            <input type="text" class="input" id="prod_weight" /></div>
            
            <div class="lbl">Supplier:
            <select class="input" id="prod_sup_id">
            <option value="">Please choose</option>
            <?php
                foreach($sup as $item){
                    echo "<option value=\"".$item["sup_id"]."\">".$item["sup_name"]."</option>";
                }                
            ?>
            </select>
            </div>
        
            <div class="lbl">Status:
                <select class="input" id="prod_status">
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
</form>

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
