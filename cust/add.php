<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<script>
$(document).ready(function(){
    $("#btnRegister").click(function () {
        addCustomer();
    });
    $("#registerForm").keypress(function (event) {
        if(event.which === 13){
            addCustomer();
        }
    });
});
</script>

<form id="registerForm" >
    <div class="registerContainer">
        <h3>CUSTOMER</h3>
        <div class="lbl">Company:
            <input type="text" class="input" id="cust_comp"/></div>
            
            <div class="lbl">Title:
                <select class="input" id="cust_title" required>
                    <option value="">Please choose</option>
                    <option value="Mr.">Mr.</option>
                    <option value="Ms.">Ms.</option>
                </select>
            </div>

        <div class="lbl">Name:
            <input type="text" class="input" id="cust_name" /></div>
            
            

        <div class="lbl">Address 1:
            <input type="text" class="input" id="cust_add_1" /></div>
            
        <div class="lbl">Address 2:
            <input type="text" class="input" id="cust_add_2" /></div>

        <div class="lbl">City:
            <input type="text" class="input" id="cust_city" /></div>

        <div class="lbl">Country:
            <select class="input" id="cust_cnt_id">
            <option value="">Please choose</option>
            <?php
                $countries = readObj("Country", "cnt_id", "-1");
                foreach($countries as $cnt){
                     if($cnt["cnt_nicename"] == "Lebanon"){
                            echo "<option value=\"".$cnt["cnt_id"]."\" selected>".$cnt["cnt_nicename"]."</option>";
                        }
                         echo "<option value=\"".$cnt["cnt_id"]."\">".$cnt["cnt_nicename"]."</option>";
                }
                ?>
            </select>
        </div>

        <div class="lbl">Tel 1:
            <input type="text" class="input" id="cust_tel_1" /></div>
            
        <div class="lbl">Tel 2:
            <input type="text" class="input" id="cust_tel_2" /></div>
            
            <div class="lbl">Fax:
            <input type="text" class="input" id="cust_fax" /></div>
            
            <div class="lbl">Email:
            <input type="text" class="input" id="cust_email" /></div>
            
             <div class="lbl">Site:
             <input type="text" class="input" id="cust_site" /></div>
             
            
            
            <input id="btnRegister" class="btnRegister" type="button" name="submit" value="SAVE"  style="float:left;"/>    
            <input class="btnRegister" type="reset" value="RESET"   style="float:left;"/>
            <input class="btnRegister" type="button" value="CANCEL" onclick="javascript:window.location.href='show.php'" style="float:left;"/>
           
           
           
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
   </div>
</form>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>

