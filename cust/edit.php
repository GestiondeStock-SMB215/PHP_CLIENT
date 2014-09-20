<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    
    $cust = readObj("Customer", "cust_id", $_GET["cust_id"])[0];
    $country = readObj("Country", "cnt_id", "-1");
?>
<script>
$(document).ready(function(){
    $("#btnRegister").click(function () {
        editCustomer();
    });
    $("#registerForm").keypress(function (event) {
        if(event.which === 13){
            editCustomer();
        }
    });
});
</script>

<form id="registerForm" >
    <div class="registerContainer">
        <h3>CUSTOMER</h3>
        <div class="lbl">Company:
            <input type="text" class="input" id="cust_comp" value="<?= $cust['cust_comp']?>"/></div>
            
            <div class="lbl">Title:
                <select class="input" id="cust_title">
                    <?php
                        if($cust['cust_title'] == "Mr."){
                            echo "<option value=\"Mr.\" selected>Mr.</option>";
                            echo "<option value=\"Ms.\">Ms.</option>";
                        }
                        else{
                            echo "<option value=\"Mr.\" >Mr.</option>";
                            echo "<option value=\"Ms.\" selected>Ms.</option>";                            
                        }
                    ?>
                </select></div>
        
        <div class="lbl">Name:
            <input type="text" class="input" id="cust_name" value="<?= $cust['cust_name']?>"/></div>

        <div class="lbl">Address 1:
            <input type="text" class="input" id="cust_add_1" value="<?= $cust['cust_add_1']?>"/></div>
            
        <div class="lbl">Address 2:
            <input type="text" class="input" id="cust_add_2" value="<?= $cust['cust_add_2']?>"/></div>

        <div class="lbl">City:
            <input type="text" class="input" id="cust_city" value="<?= $cust['cust_city']?>"/></div>

        <div class="lbl">Country:
            <select class="input" id="cust_cnt_id" value="<?= $cust['cust_cnt_id']?>">
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
            <input type="text" class="input" id="cust_tel_1" value="<?= $cust['cust_tel_1']?>"/></div>
            
        <div class="lbl">Tel 2:
            <input type="text" class="input" id="cust_tel_2" value="<?= $cust['cust_tel_2']?>"/></div>
            
            <div class="lbl">Fax:
            <input type="text" class="input" id="cust_fax" value="<?= $cust['cust_fax']?>"/></div>
            
            <div class="lbl">Email:
            <input type="text" class="input" id="cust_email" value="<?= $cust['cust_email']?>"/></div>
            
             <div class="lbl">Site:
             <input type="text" class="input" id="cust_site" value="<?= $cust['cust_site']?>" /></div>
             
            
            
            <input id="btnRegister" class="btnRegister" type="button" name="submit" value="SAVE"  style="float:left;"/>    
            <input class="btnRegister" type="button" value="CANCEL" onclick="javascript:window.location.href='show.php'" style="float:left;"/>
           
           
           
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
   </div>
    <input type="text" id="cust_id" value="<?=$_GET['cust_id']?>" style="display:none" />
</form>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>

