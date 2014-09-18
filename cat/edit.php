<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    if(!isset($_GET["cat_id"])){
        header("location:show.php");
    }
    
    $cats = readObj("Category", "cat_id", $_GET["cat_id"])[0];
?>
<script>
$(document).ready(function(){
    $("#btnRegister").click(function () {
        editCategory();
    });
    $("#registerForm").keypress(function (event) {
        if(event.which === 13){
            editCategory();
        }
    });
});
</script>
<form id="registerForm" >
    <div class="registerContainer">
        <h3>CATEGORY</h3>

        <div class="lbl">Name:
            <input type="text" class="input" id="cat_name" value="<?= $cats["cat_name"] ?>"/></div>

        <div class="lbl">Description:
            <input type="text" class="input" id="cat_desc" value="<?= $cats["cat_desc"] ?>" /></div>
        <input type="text" id="cat_id" value="<?= $cats["cat_id"] ?>" style="display:none"/>
        <input id="btnRegister" class="btnRegister" type="button" value="SAVE"  style="float:left;"/>    
        <input class="btnRegister" type="button" value="CANCEL" onclick="javascript:window.location.href='show.php'" style="float:left;"/>
        
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div>
</form>   

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
