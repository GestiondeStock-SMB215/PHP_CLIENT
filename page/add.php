<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<script>
$(document).ready(function(){
    //getRoles();
    $("#btnRegister").click(function () {
        addUser();
    });
    $("#registerForm").keypress(function (event) {
        if(event.which === 13){
            addUser();
        }
    });
    $("#user_username").blur(function () {
        checkUserNameValidity();
    });
    $("#user_email").blur(function () {
        checkUserEmailValidity();
    });
});
</script>
<form id="registerForm" >
    <div class="registerContainer">
        <div class="lbl">Parent page:
            <div class="ddl">
                <select id="page_parent_id">
                    <option value="5">Please choose</option>
                    <option value="0">Root</option>
                    <?= getRootPages() ?>
                </select>
            </div>
        </div>

        <div class="lbl">Name:
            <input type="text" class="input" id="page_name" /></div>

        <div class="lbl">URL:
            <input type="text" class="input" id="page_url" /></div>

        <div class="lbl">ACL:
            <input type="text" class="input" id="page_acl" /></div>

        <div class="lbl">IN MENU:
            <input type="checkbox" class="input" id="page_in_menu" /></div>

        <input id="btnRegister" class="btnRegister" name="submit" type="button" value="Register" />
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div
</form>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>