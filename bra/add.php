<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>

<form id="registerForm"action="add.php" >
    <div class="registerContainer">
        <h3>BRANCHE</h3>

        <div class="lbl">Name:
            <input type="text" class="input" id="bra_name" /></div>

        <div class="lbl">Country:
            <select class="input" id="bra_cnt_id">
            <option value="">Please choose</option>
            <?= getCountries(); ?>
            </select>
        </div>
            

        <div class="lbl">City:
            <input type="text" class="input" id="bra_city" /></div>

        <div class="lbl">Street:
            <input type="text" class="input" id="bra_add_srt" /></div>

        <div class="lbl">Address 1:
            <input type="text" class="input" id="bra_add_1" /></div>
            
        <div class="lbl">Tel 1:
            <input type="text" class="input" id="bra_tel_1" /></div>
            
        <div class="lbl">Tel 2:
            <input type="text" class="input" id="bra_tel_2" /></div>
            
        <div class="lbl">Fax:
            <input type="text" class="input" id="bra_fax" /></div>
            
        <div class="lbl">Email:
            <input type="text" class="input" id="bra_email" /></div>

        <input id="btnRegister" class="btnRegister" type="reset" value="CANCEL" style="float:left;" />
        <input id="btnRegister" class="btnRegister" name="submit" type="submit" value="SAVE" />    

        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div
</form>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>

<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>

