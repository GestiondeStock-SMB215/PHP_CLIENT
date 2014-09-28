<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    
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
        
        $.ajax({
            url:"add.php",
            type:"POST",
            beforeSend:function(){
                
            },
            complete:function(){
               getDesc();
               getPrice(); 
            },
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
<script type="text/javascript">
    function Calc(q) {
         price = document.getElementById('prod_vend_id');
        if (price.value !== "" && !isNaN(price.value))
        {
         p = parseFloat(price.value);
         
         return q*p;
        }
       
     return q*price;
 }
</script>
<div class="orderInContainer">
    <div class="title">Order In </div>
    <div class="chooseDate">
        <div class="lbl">Date Time</div> 
        <input type="text" class="inputDate" id="orderInDate" />
        <div class="infoHolder dateTime" style="display:none;">
            <div class="infoHolderContent">
                <div id="datepicker"></div>
                <div class="calendarInfoBox"></div>
            </div>                       
        </div>
        <div class="calendarTxt" style="display: none;"></div>  
    </div>
    <div class="clear"></div>
    <table class="tab">
        <tr>
            <td class="lbl">Product</td> 
            <td class="lbl">Description</td>
            <td class="lbl">Quantity</td>
            <td class="lbl">Price</td>
            <td class="lbl">Total</td>
            <td></td>
        </tr>
        <tr>
            <td>
                <select id="prod_id" class="lblInput" type="text" >
                    <option>Select Product</option>
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
            <td><input id="prod_desc" class="lblInput" type="text" readonly/></td>
            <form name="calcul">
            <td><input id="order_in_det_qty" class="lblInput" type="text" onblur="document.calcul.total.value=Calc(this.value);"/></td>
            <td><input id="prod_vend_id" class="lblInput" type="text" readonly />
            <?php
                                                    foreach($product as $prod){
                                                        if($prod["prod_name"] == ""){
                                                            echo "<option value=\"".$prod["prod_id"]."\" selected>".$prod["prod_vend_id"]."</option>";
                                                        }
                                                        else{
                                                            echo "<option value=\"".$prod["prod_id"]."\">".$prod["prod_vend_id"]."</option>";
                                                        }
                                                    }                
                                                ?>
                </td>
            <td><input id="total" class="lblInput" type="text" value="0.00" readonly/></td>
            <td><input type="button" id="addNewProduct" /></td>
        </tr>
    </table>
    
   
 
    <div class="txtInput" style="height:100px;">
        <input id="" class="btnRegister" name="Back" type="button" value="Cancel" onclick="javascript=window.location.href='show.php'" />        
        <input id="btnAdd" class="btnRegister" type="button" type="button" value="Add Product" />
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div>
</div>

<script type="text/javascript">
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
<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
