<?php
    $acl = 1;
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>

   
<form id="registerForm" name="category" method="POST" action="add.php" >
    <div class="registerContainer">
        <h3>CATEGORY</h3>

        <div class="lbl">Name:
            <input type="text" class="input" id="cat_name" /></div>

        <div class="lbl">Description:
            <input type="text" class="input" id="cat_desc" /></div>

        <div class="lbl">Short Name:
            <input type="text" class="input" id="shortname" /></div>

          
        <input id="btnRegister" class="btnRegister" type="reset" value="CANCEL" style="float:left;" />
        <input id="btnRegister" class="btnRegister" name="submit" type="submit" value="SAVE" />
        
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div
</form>   
<script langage="javascript">
       $("#cat_desc").keyup(function(){
    $("#shortname").val($(this).val().substring(0,10));
});
</script>
