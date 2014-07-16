<?php
    $acl = 1;
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<div class="registerContainer">
    <div class="lbl">Name:
        <input type="text" class="input" id="txtName" /></div>
          
    <div class="lbl">Username:
        <input type="text" class="input" id="txtUsername" /></div>
    
    <div class="lbl">Email:
        <input type="text" class="input" id="txtEmail" /></div>
          
    <div class="lbl">Password:
        <input type="password" class="input" id="txtPswd" /></div>
          
    <div class="lbl">Confirm Password:
        <input type="password" class="input" id="txtConf" /></div>
    
    <input id="btnRegister" class="btnRegister" name="submit" type="submit" value="Register" />
    <div class="loader"></div>
    <div class="lblMsg"></div>
</div>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>