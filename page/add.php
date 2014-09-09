<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<script>
$(document).ready(function(){
    $("#btnRegister").click(function () {
        addPage()();
    });
    $("#registerForm").keypress(function (event) {
        if(event.which === 13){
            addPage();
        }
    });
});
</script>
<form id="registerForm" >
    <div class="registerContainer">
        <div class="lbl">Parent page:
            <div class="ddl">
                <select id="page_parent_id" >
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
            <select class="input" id="page_acl">
                <option value="">Please choose</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="lbl">IN MENU:
            <input type="checkbox" class="input" id="page_in_menu" /></div>
        <div class="lbl">ORDER:
            <input type="number" class="input" id="page_order" /></div>
        <input id="btnRegister" class="btnRegister" name="submit" type="button" value="Register" />
        <input id="" class="btnRegister" name="Back" type="button" value="Cancel" onclick="javascript=window.location.href='show.php'" />        
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div
</form>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>