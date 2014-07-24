<?php
    $acl = 1;
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<script src="/resources/js/profile.js"></script>
<form id="updateForm" >
    <div class="registerContainer">
        <div class="lbl">Name:
            <input type="text" class="input" id="user_name" value="<?= $_SESSION["user"]["user_name"] ?>" /></div>

        <div class="lbl">Username:
            <input type="text" class="input" id="user_username" value="<?= $_SESSION["user"]["user_username"] ?>" /></div>

        <div class="lbl">Email:
            <input type="text" class="input" id="user_email" value="<?= $_SESSION["user"]["user_email"] ?>" /></div>

        <div class="lbl">Password:
            <input type="password" class="input" id="user_password" /></div>
        
        <div class="lbl">Confirm Password:
            <input type="password" class="input" id="user_password_conf" /></div>
            
        <input id="btnUpdate" class="btnRegister" name="submit" type="button" value="Update" />
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div
</form>

<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>