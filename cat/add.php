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

        <div class="lbl">Short Name:
            <input type="text" class="input" id="shortname" readonly/></div>
            
        <div class="lbl">Pic:
          <input type="file" class="input" id="cat_pic"/></div>

          
        <input id="btnRegister" class="btnRegister" name="submit" value="SAVE"  style="float:left;"/>    
        <input class="btnRegister" type="reset" value="RESET"   style="float:left;"/>
        <input class="btnRegister" type="reset" value="CANCEL" onclick="javascript:window.location.href='show.php'" style="float:left;"/>
        
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div>
</form>   

<script>
    $("#cat_desc").keyup(function(){
    $("#shortname").val($(this).val().substring(0,10));
});
    </script>