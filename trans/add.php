<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    
    $branch = readObj("Branch", "bra_id", "-1");
    $product = readObj("Product", "prod_id", "-1"); 
?>

<script type="text/javascript" src="../resources/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="../resources/js/jquery.ui.datepicker.js"></script>
<link href="../resources/css/jquery.ui.datepicker.css" rel="stylesheet" /> 
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
    $("#prod_id").blur(function(){
        getDesc();
    });
});
$(document).ready(function (){
        $(".calendarTxt").html($.datepicker.formatDate('yy-MM-dd', new Date()));
        $("#orderInDate").val($.datepicker.formatDate("yy-MM-dd", new Date()));

        $("#datepicker").datepicker({ prevText: '<', nextText: '>', minDate: 0, autoSize: true, onChangeMonthYear: function () { $(".calendarInfoBox").hide() }, onSelect: function (dateText, inst) {
            dd = dateText;
            $(".timeContentTxt").css({ "background-color": "transparent", "color": "#656565" });
            $(".calendarInfoBox").show();
            $("#dateLanguage").html(ddd);
        }
        });

        $(".ui-datepicker-calendar td").live("click", function (e) {
            var d = $(".calendarInfoBox");
            d.css("position", 'absolute');
            var position = $(".ui-state-active").parent().position();
            $(".calendarTxt").html($.datepicker.formatDate("yy-MM-dd", new Date(dd)));
             $("#orderInDate").val($.datepicker.formatDate("yy-MM-dd", new Date(dd)));
            $(".calendarInfoBox").css("left", (position.left + 35) + 'px');
            $(".calendarInfoBox").css("top", (position.top - 7) + 'px');
            $("#dateLanguage").html(ddd);
        });
        
        $("#orderInDate").click(function(){
            $(".infoHolder").slideToggle();
        });
        
         $("#btnAdd").click(function(){
          
        });
    });
     
			
</script>

<form class="orderInContainer">
    <div class="orderInContainer">
    <div class="title"><h3>Transfert</h3></div>
    <div class="headOrderIn">
        <div class="lbl" style="width: 208px;height: 30px;float: left;text-align: center;">DATE:</div> 
        <div class="lbl" style="width: 208px;height: 30px;float: left;text-align: center;">FROM:</div> 
        <div class="lbl" style="width: 208px;height: 30px;float: left;text-align: center;">TO:</div>
        
    </div>
    <div class="headOrderIn" style="width: 960px;height: 96px;padding-left: 37px;">
       <div class="orderInContent" >
           <input type="text" class="inputDate" id="orderInDate" readonly="1" style="width: 150px;height: 20px;float: left;padding-left: 5px;" />
        <div class="lblInput" style="width: 150px;height: 22px; padding-left: 66px;">
         <select class="input" id="trans_src_bra_id" >
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
        <div class="lblInput" style="width: 150px;height: 22px;padding-left: 66px;" >
            <select class="input" id="trans_dest_bra_id" >
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
         
        </div>
        </div>
    </div>
         
        
        <table cellpadding="5" cellspacing="0" border="1" id="t1">
			<tr style="background-color:#a0a0a0;">
                            <div class="headOrderIn">
				<th>ITEM</th>
				<th>DESCRIPTION</th>
				<th>QUANTITY</th>
                                <th>ADD</th>
				<th>DELETE</th>
			</tr>
                        
			<tr>
				<form action="add.php" method="post">
					<td>
                                            <select class="input" id="prod_id" required tabindex="1"/>
                                            <option value=""></option>
                                                <?php
                                                    foreach($product as $prod){
                                                        if($prod["prod_name"] == ""){
                                                            echo "<option value=\"".$prod["prod_id"]."\" selected>".$prod["prod_name"]."</option>";
                                                        }
                                                        else{
                                                            echo "<option value=\"".$prod["prod_id"]."\">".$prod["prod_name"]."</option>";
                                                        }
                                                    }                
                                                ?>
                                                </select>
                                        </td>
                                        <td>
                                            <input type="text" id="prod_desc" readonly>
                                        </td>
					<td>
                                            <input type="text" name="trans_det_qty" value="0" required tabindex="4"/>
                                        <td>
                                            <input type="submit" value="Ok"/>
                                        </td>
                                       
                                        
                                        
				</form>
			</tr>
			
		</table>
       
             
            
            
            <input id="btnRegister" class="btnRegister" type="button" name="submit" value="SAVE"  style="float:left;"/>    
            <input class="btnRegister" type="reset" value="RESET"   style="float:left;"/>
            <input class="btnRegister" type="button" value="CANCEL" onclick="javascript:window.location.href='show.php'" style="float:left;"/>
           
           
           
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
   
</form>

<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>


