<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    $braId = $_GET['bra_id'];
?>
<script>
$(document).ready(function(){
    var bra_id = "<?php echo($bra_id); ?>";
    
    getBranches(bra_id);
    $("#btnEdit").click(function () {
        addBranch(bra_id);
    });
    $("#editForm").keypress(function (event) {
        if(event.which === 13){
            addBranch(bra_id);
        }
    });
    
    /*hala new getBranches*/
    function getBranches(bra_id){
        wantedData = {bra_id:bra_id};
        
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax.php?func=getBranches",
            data         : wantedData,
            cache        : false,
            dataType     : "json",
            beforeSend   : function () {
                $('#lblMsg').html("");
                $('#loader').show();
            },
            complete: function () {
                $('#loader').hide();
            },
            success : function(result){
                    $("#bra_name").val(result.bra_name);
                    $("#bra_cnt_id").val(result.bra_cnt_id);
                    $("#bra_city").val(result.bra_city);
                    $("#bra_add_srt").val(result.bra_add_srt);
                    $("#bra_add_1").val(result.bra_add_1);
                    $("#bra_tel_1").val(result.bra_tel_1);
                    $("#bra_tel_2").val(result.bra_tel_2);
                    $("#bra_fax").val(result.bra_fax);
                    $("#bra_email").val(result.bra_email);
                }
        });
    }
});
</script>
<form id="editForm" >
    <div class="editContainer">
        <h3>BRANCH</h3>
        
        <div class="lbl">Name:
            <input type="text" class="input" id="bra_name" /></div>

        <div class="lbl">Country:
            <select class="input" id="bra_cnt_id">
            <option value="">Please choose</option>
            <?php
                $coutries = getCountries();
                foreach($coutries as $country){
                    if($country["cnt_nicename"] == "Lebanon"){
                        echo "<option value=\"".$country["cnt_id"]."\" selected>".$country["cnt_nicename"]."</option>";
                    }
                    else{
                        echo "<option value=\"".$country["cnt_id"]."\">".$country["cnt_nicename"]."</option>";
                    }
                }                
            ?>
            </select>
        </div>
            

        <div class="lbl">City:
            <input type="text" class="input" id="bra_city" /></div>

        <div class="lbl">Street:
            <input type="text" class="input" id="bra_add_srt" /></div>

        <div class="lbl">Address 1:
            <input type="text" class="input" id="bra_add_1" /></div>
            
        <div class="lbl">Tel 1:
            <input type="text" class="input" id="bra_tel_1" /></div>
            
        <div class="lbl">Tel 2:
            <input type="text" class="input" id="bra_tel_2" /></div>
            
        <div class="lbl">Fax:
            <input type="text" class="input" id="bra_fax" /></div>
            
        <div class="lbl">Email:
            <input type="text" class="input" id="bra_email" /></div>
        
        <input id="btnEdit" class="btnRegister" name="submit" value="SAVE"  style="float:left;"/>    
        <input class="btnEdit" type="reset" value="RESET"   style="float:left;"/>
        <input class="btnEdit" type="reset" value="CANCEL" onclick="javascript:window.location.href='show.php'" style="float:left;"/>
        

        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div>
</form>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>