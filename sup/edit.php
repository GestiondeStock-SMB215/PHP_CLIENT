<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    if(!isset($_GET["sup_id"])){
        header("location:show.php");
    }
    
    $bra = readObj("Supplier", "sup_id", $_GET["sup_id"])[0];
    $country = readObj("Country", "cnt_id", "-1");
?>
<script>
$(document).ready(function(){
    $("#btnRegister").click(function () {
        editSupplier();
    });
    $("#registerForm").keypress(function (event) {
        if(event.which === 13){
            editSupplier();
        }
    });
});
</script>

<form id="registerForm" >
    <div class="registerContainer">
        <h3>SUPPLIER</h3>
        <div class="lbl">Company:
            <input type="text" class="input" id="sup_comp"/></div>

        <div class="lbl">Name:
            <input type="text" class="input" id="sup_name" /></div>
            
            <div class="lbl">Title:
            <input type="text" class="input" id="sup_title" /></div>

        <div class="lbl">Address 1:
            <input type="text" class="input" id="sup_add_1" /></div>
            
        <div class="lbl">Address 2:
            <input type="text" class="input" id="sup_add_2" /></div>

        <div class="lbl">City:
            <input type="text" class="input" id="sup_city" /></div>

        <div class="lbl">Country:
            <select class="input" id="sup_cnt_id" value="<?= $sup['sup_cnt_id']?>">
                <?php
                    foreach($country as $cnt){
                        if($sup["sup_cnt_id"] == $cnt["cnt_id"]){
                            echo "<option selected value=\"".$cnt["cnt_id"]."\">".$cnt["cnt_name"]."</option>";
                        }
                        else{
                            echo "<option value=\"".$cnt["cnt_id"]."\">".$cnt["cnt_name"]."</option>";
                        }
                    }
                ?>
            </select>
        </div>

        <div class="lbl">Tel 1:
            <input type="text" class="input" id="sup_tel_1" /></div>
            
        <div class="lbl">Tel 2:
            <input type="text" class="input" id="sup_tel_2" /></div>
            
            <div class="lbl">Fax:
            <input type="text" class="input" id="sup_fax" /></div>
            
            <div class="lbl">Email:
            <input type="text" class="input" id="sup_email" /></div>
            
             <div class="lbl">Site:
             <input type="text" class="input" id="sup_site" /></div>
             
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

