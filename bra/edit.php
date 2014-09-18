<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    if(!isset($_GET["bra_id"])){
        header("location:show.php");
    }
    
    $bra = readObj("Branch", "bra_id", $_GET["bra_id"])[0];
    $country = readObj("Country", "cnt_id", "-1");
?>
<script>
$(document).ready(function(){
    $("#btnRegister").click(function () {
        editBranch();
    });
    $("#registerForm").keypress(function (event) {
        if(event.which === 13){
            editBranch();
        }
    });
});
</script>
<form id="editForm" >
    <div class="editContainer">
        <h3>BRANCH</h3>
        
        <div class="lbl">Name:
            <input type="text" class="input" id="bra_name" value="<?= $bra['bra_name']?>"/></div>

         <div class="lbl">Country:
            
                <select class="input" id="bra_cnt_id" value="<?= $bra['bra_cnt_id']?>">
                    <?php
                        foreach($country as $cnt){
                            if($bra["bra_cnt_id"] == $cnt["cnt_id"]){
                                echo "<option selected value=\"".$cnt["cnt_id"]."\">".$cnt["cnt_name"]."</option>";
                            }
                            else{
                                echo "<option value=\"".$cnt["cnt_id"]."\">".$cnt["cnt_name"]."</option>";
                            }
                        }
                    ?>
                </select>
            
        </div>
            

        <div class="lbl">City:
            <input type="text" class="input" id="bra_city" value="<?= $bra['bra_city']?>"/></div>

        <div class="lbl">Street:
            <input type="text" class="input" id="bra_add_str" value="<?= $bra['bra_add_str']?>" /></div>

        <div class="lbl">Address 1:
            <input type="text" class="input" id="bra_add_1" value="<?= $bra['bra_add_1']?>"/></div>
            
        <div class="lbl">Tel 1:
            <input type="text" class="input" id="bra_tel_1" value="<?= $bra['bra_tel_1']?>"/></div>
            
        <div class="lbl">Tel 2:
            <input type="text" class="input" id="bra_tel_2" value="<?= $bra['bra_tel_2']?>"/></div>
            
        <div class="lbl">Fax:
            <input type="text" class="input" id="bra_fax" value="<?= $bra['bra_fax']?>"/></div>
            
        <div class="lbl">Email:
            <input type="text" class="input" id="bra_email" value="<?= $bra['bra_email']?>"/></div>
            
            
        
        <input id="btnRegister" class="btnRegister" type="button" value="SAVE"  style="float:left;"/>    
        <input class="btnRegister" type="button" value="CANCEL" onclick="javascript:window.location.href='show.php'" style="float:left;"/>
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div>
    <input type="text" id="bra_id" value="<?=$_GET['bra_id']?>" style="display:none" />
</form>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>