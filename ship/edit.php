<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    
    $ship = readObj("Shipper", "ship_id", $_GET["ship_id"])[0];
?>
<script>
$(document).ready(function(){
    $("#btnRegister").click(function () {
        editShipper();
    });
    $("#registerForm").keypress(function (event) {
        if(event.which === 13){
            editShipper();
        }
    });
});
</script>

<form id="registerForm" >
    <div class="registerContainer">
        <h3>Shipper</h3>
        
        <div class="lbl">Name:
            <input type="text" class="input" id="ship_name" value="<?= $ship['ship_name']?>"/></div>
        
        <div class="lbl">Type:
            <input type="text" class="input" id="ship_type" value="<?= $ship['ship_type']?>" /></div>    

        <div class="lbl">Address 1:
            <input type="text" class="input" id="ship_add_1" value="<?= $ship['ship_add_1']?>" /></div>
            
        <div class="lbl">Address 2:
            <input type="text" class="input" id="ship_add_2" value="<?= $ship['ship_add_2']?>" /></div>

        <div class="lbl">Tel 1:
            <input type="text" class="input" id="ship_tel_1" value="<?= $ship['ship_tel_1']?>" /></div>
            
        <div class="lbl">Tel 2:
            <input type="text" class="input" id="ship_tel_2" value="<?= $ship['ship_tel_2']?>" /></div>
            
            <div class="lbl">Fax:
            <input type="text" class="input" id="ship_fax" value="<?= $ship['ship_fax']?>" /></div>
            
            <div class="lbl">Email:
            <input type="text" class="input" id="ship_email" value="<?= $ship['ship_email']?>" /></div>
            
            <div class="lbl">Taxable:
                <input type="checkbox" class="input" id="ship_taxable" value="<?= $ship['ship_taxable']?>" /></div>
             
            
            
            <input id="btnRegister" class="btnRegister" type="button" name="submit" value="SAVE"  style="float:left;"/> 
            <input class="btnRegister" type="button" value="CANCEL" onclick="javascript:window.location.href='show.php'" style="float:left;"/>
           
           
           
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
   </div>
</form>
<input type="text" id="ship_id" value="<?=$_GET['ship_id']?>" style="display:none" />
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>

