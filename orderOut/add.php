<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
$product = readObj("Product", "prod_id", "-1"); 
?>
<script type="text/javascript" src="../resources/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="../resources/js/jquery.ui.datepicker.js"></script>
<link href="../resources/css/jquery.ui.datepicker.css" rel="stylesheet" /> 
<script type="text/javascript">
    $(document).ready(function (){
        
        $("#prod_id").blur(function(){
        getDesc();
        });
        $("#prod_id").blur(function(){
        getPrice();
        });
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
    <div class="title">Order Out </div>
    <div class="headOrderIn">
        <div class="lbl">Date Time</div> 
        <div class="lbl">Product</div> 
        <div class="lbl">Description</div>
        <div class="lbl">Quantity</div>
        <div class="lbl">Price</div>
        <div class="lbl">Total</div>
    </div>
    <div class="clear"></div>
    
    <div class="orderInContent">
        <input type="text" class="inputDate" id="orderInDate" />
        <div class="calendarTxt" style="display: none;"></div>  
        <select id="prod_id" class="lblInput" type="text" >
            
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
        <input id="prod_desc" class="lblInput" type="text" readonly />
        <form name="calcul">
        <input id="order_out_det_qty" class="lblInput" type="text" onblur="document.calcul.total.value=Calc(this.value);" />
        <input id="prod_vend_id" class="lblInput" type="text" readonly >
            
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
        
        <input id="total" class="lblInput" type="text" value="0.00" readonly/>
        </form>
        <div class="infoHolder dateTime" style="display:none;float:left;">
            <div class="infoHolderContent">
                <div id="datepicker"></div>
                <div class="calendarInfoBox"></div>
            </div>                       
        </div>
        
         
    </div>
    
    
    
    <div class="txtInput" style="height:100px;">
        <input id="" class="btnRegister" name="Back" type="button" value="Cancel" onclick="javascript=window.location.href='show.php'" />        
        <input id="btnAdd" class="btnRegister" type="button" type="button" value="Add Product" />
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div>
</div>

<div id="order"></div>





<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
