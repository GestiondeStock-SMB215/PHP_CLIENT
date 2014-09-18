<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<script>
$(document).ready(function(){
    $("#btnRegister").click(function () {
        addCategory();
    });
    $("#registerForm").keypress(function (event) {
        if(event.which === 13){
            addCategory();
        }
    });
});
</script>
<form id="registerForm" >
    <div class="registerContainer">
        <h3>CATEGORY</h3>

        <div class="lbl">Name:
            <input type="text" class="input" id="cat_name" /></div>

        <div class="lbl">Description:
            <input type="text" class="input" id="cat_desc" /></div>
          
        <input id="btnRegister" class="btnRegister" type="button" value="SAVE"  style="float:left;"/>    
        <input class="btnRegister" type="reset" value="RESET"   style="float:left;"/>
        <input class="btnRegister" type="button" value="CANCEL" onclick="javascript:window.location.href='show.php'" style="float:left;"/>
        
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div>
</form>   

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
