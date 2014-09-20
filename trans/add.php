<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    
    $branch = readObj("Branch", "bra_id", "-1");
    $prod = readObj("Product", "prod_id", "-1"); 
?>
<script>
$(document).ready(function(){
    $("#btnRegister").click(function () {
        addTransfert();
    });
    $("#registerForm").keypress(function (event) {
        if(event.which === 13){
            addTransfert();
        }
    });
});

//add description
				$(document).ready(function(){
					$("#prod_id").blur(function(){
						$.ajax({
							url:"add.php",
							type:"POST",
							data:{
								prod_id: $("#prod_id").val(),
							},
							success:function(jsonStr){
								$("#prod_desc").val(jsonStr);
							}
						});
					});
				});
			
</script>

<form id="registerForm" >
    <div class="registerContainer">
        <h3>Transfert</h3>
    <div class="lbl">Date:
            <input type="text" class="input" id="trans_send_date" /></div>  
         <div class="lbl">From:
            <select class="input" id="trans_src_bra_id">
            <option value="">Please choose</option>
            <?php
                foreach($branch as $bra){
                    if($bra["bra_name"] == ""){
                        echo "<option value=\"".$bra["bra_id"]."\" selected>".$bra["bra_name"]."</option>";
                    }
                    else{
                        echo "<option value=\"".$bra["bra_id"]."\">".$bra["bra_name"]."</option>";
                    }
                }                
            ?>
            </select>
            </div>
        <div class="lbl">To:
            <select class="input" id="trans_dest_bra_id">
            <option value="">Please choose</option>
            <?php
                foreach($branch as $bra){
                    if($bra["bra_name"] == ""){
                        echo "<option value=\"".$bra["bra_id"]."\" selected>".$bra["bra_name"]."</option>";
                    }
                    else{
                        echo "<option value=\"".$bra["bra_id"]."\">".$bra["bra_name"]."</option>";
                    }
                }                
            ?>
            </select>
            </div>
        
        <table cellpadding="5" cellspacing="0" border="1" id="t1">
			<tr style="background-color:#a0a0a0;">
				<th>ITEM</th>
				<th>DESCRIPTION</th>
				<th>Quantity</th>
				<th>DELETE</th>
			</tr>
			<tr>
				<form action="add.php" method="post">
					<td><input type="text" id="trans_det_prod_id"required tabindex="1" /></td>
                                        <td><input type="text" id="prod_desc" readonly>
                                        <?php
                                        ?>
                                        </td>
					<td><input type="text" name="trans_det_qty" value="0" required tabindex="4"/><input type="submit" value="Add"/></td>
					<td></td>
				</form>
			</tr>
			
		</table>
       
             
            
            
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

