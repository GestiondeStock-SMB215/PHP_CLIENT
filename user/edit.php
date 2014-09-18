<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    if(!isset($_GET["user_id"])){
        header("location:show.php");
    }
    $roles = readObj("Role", "role_id", "-1");
    $user = readObj("User", "user_id", $_GET["user_id"])[0];

    
?>
<script>
$(document).ready(function(){
    $("#btnRegister").click(function () {
        editUser();
    });
    $("#registerForm").keypress(function (event) {
        if(event.which === 13){
            editUser();
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
<form id="registerForm" 
    <div class="registerContainer">
        <div class="lbl">Role:
            <div class="ddl">
                <select id="user_role_id">
                    <?php
                        foreach($roles as $role){
                            if($user["user_role_id"] == $role["role_id"]){
                                echo "<option selected value=\"".$role["role_id"]."\">".$role["role_name"]."</option>";
                            }
                            else{
                                echo "<option value=\"".$role["role_id"]."\">".$role["role_name"]."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="lbl">Name:
            <input type="text" class="input" id="user_name" value="<?= $user["user_name"] ?>" /></div>

        <div class="lbl">Username:
            <input type="text" class="input" id="user_username"  value="<?= $user["user_username"] ?>"/></div>

        <div class="lbl">Email:
            <input type="text" class="input" id="user_email"  value="<?= $user["user_email"] ?>"/></div>

        <div class="lbl">Password:
            <input type="password" class="input" id="user_password" /></div>

        <div class="lbl">Confirm Password:
            <input type="password" class="input" id="user_password_conf" /></div>

        <div class="lbl">Status:
            <div class="ddl">
                <select id="user_status">
                    <?php
                        if($user["user_status"] == "1"){
                            echo "<option value=\"1\" selected>Active</option>";
                            echo "<option value=\"2\">Inactive</option>";
                        }
                        else{
                            echo "<option value=\"1\" >Active</option>";
                            echo "<option value=\"2\" selected>Inactive</option>";                            
                        }
                    ?>

                </select>
            </div>
        </div>
        <input type="text" id="user_id" value="<?=$_GET["user_id"]?>" style="display:none" />
        <input id="btnRegister" class="btnRegister" type="button" type="button" value="Register" />
        <input id="" class="btnRegister" name="Back" type="button" value="Cancel" onclick="javascript=window.location.href='show.php'" />                
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div
</form>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
