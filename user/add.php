<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<script>
$(document).ready(function(){
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
        <div class="lbl">Role:
            <div class="ddl">
                <select id="user_role_id">
                    <option value="">Please choose</option>
                    <?php
                        $roles = readObj("Role", "role_id", "-1");
                        foreach($roles as $role){
                            echo "<option value=\"".$role["role_id"]."\">".$role["role_name"]."</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        
        <div class="lbl">Branch:
            <div class="ddl">
                <select id="user_bra_id">
                    <option value="">Please choose</option>
                    <?php
                        $branches = readObj("Branch", "bra_id", "-1");
                        foreach($branches as $branch){
                            echo "<option value=\"".$branch["bra_id"]."\">".$branch["bra_name"]."</option>";
                        }
                    ?>
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
        <input id="btnRegister" class="btnRegister" type="button" type="button" value="Register" style="float:left;"/>    
        <input class="btnRegister" type="reset" value="RESET"   style="float:left;"/>
        <input id="" class="btnRegister" name="Back" type="button" value="Cancel" onclick="javascript=window.location.href='show.php'" />                
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div
</form>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>