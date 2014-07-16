<?php
    $acl = 1;
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<script src="/resources/js/addUser.js"></script>
<form id="registerForm" >
    <div class="registerContainer">
        <div class="lbl">Role:
            <div class="ddl">
                <select id="user_role_id">
                    <option value="">Please choose</option>
                    <?= getRoles() ?>
                </select>
            </div>
        </div>

        <div class="lbl">Name:
            <input type="text" class="input" id="user_name" /></div>

        <div class="lbl">Username:
            <input type="text" class="input" id="user_username" /></div>

        <div class="lbl">Email:
            <input type="text" class="input" id="user_email" /></div>

        <div class="lbl">Password:
            <input type="password" class="input" id="user_password" /></div>

        <div class="lbl">Confirm Password:
            <input type="password" class="input" id="user_password_conf" /></div>

        <div class="lbl">Status:
            <div class="ddl">
                <select id="user_status">
                    <option value="">Please choose</option>
                    <option value="1">Active</option>
                    <option value="2">Inactive</option>
                </select>
            </div>
        </div>        

        <input id="btnRegister" class="btnRegister" name="submit" type="button" value="Register" />
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div
</form>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>