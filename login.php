<?php
    $acl = 4;
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<script src="/resources/js/getUserByUsername.js"></script>
<form id="loginform">
    <div class="index">
        <div class="indexInfo">
            <div class="logo">GSS</div>                 
            <div id="loginContainer" class="loginContainer">
                <input type="text" id="txtUsername" name="user_username" class="input" placeholder="Username" />
                <div class="clear"></div>
                <input type="password" id="txtPswd" name="user_password" class="input" placeholder="Password"  />
                <div class="clear"></div>
                <input type="button" id="btnLogin" class="btnLogin" value="LOGIN" />
                <div class="clear"></div>
                <img id="loginLoader" alt="" src="/resources/img/loading.gif" style="display: none;width:20px;margin-top: 4px;" />
                <div id="lblMsgLogin" class="lblMsg"></div>
            </div>
        </div>
    </div>
</form>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>