<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
$product = readObj("Product", "prod_id", "-1"); 
    $sup = readObj("Supplier", "sup_id", "-1");
?>
<script type="text/javascript" src="../resources/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="../resources/js/jquery.ui.datepicker.js"></script>
<link href="../resources/css/jquery.ui.datepicker.css" rel="stylesheet" /> 
<script type="text/javascript">
    var q;
    $(document).ready(function (){
        
         $("#prod_id").blur(function(){
             if ($("#prod_id").val() != "Select"){ 
                $.ajax({
                    url:"add.php",
                    type:"POST",
                    beforeSend : function(){},
                    complete : function(){
                        getDesc();
                        getPrice();                    
                    },
                    data:{
                        prod_id: $("#prod_id").val(),
                    },
                    success:function(jsonStr){
                            $("#prod_desc").val(jsonStr);
                             $("#total").val("0.00"); 
                             $("#order_out_det_qty").val("0"); 
                    }
                });
             }
             else
             {
                 $("#prod_vend_id").val("");
                 $("#prod_desc").val(""); 
                 $("#total").val("0.00"); 
                 $("#order_out_det_qty").val("0"); 
             }
        });
        $(".calendarTxt").html($.datepicker.formatDate('yy-MM-dd', new Date()));
        $("#ord_out_date").val($.datepicker.formatDate("yy-MM-dd", new Date()));

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
            $("#ord_out_date").val($.datepicker.formatDate("yy-MM-dd", new Date(dd)));
            $(".calendarInfoBox").css("left", (position.left + 35) + 'px');
            $(".calendarInfoBox").css("top", (position.top - 7) + 'px');
            $("#dateLanguage").html(ddd);
        });
        
        $("#ord_out_date").click(function(){
            $(".infoHolder").slideToggle();
        });
        
        $("#order_out_det_qty").blur(function(){
            var qty = $("#order_out_det_qty").val();  
            q = parseInt(qty,10);
            $("#total").val(Calc(q));  
        });
        
        $("#btnAdd").click(function(){
          
        }); 
        
    });
    
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
    <div class="chooseDate">
        <div class="lbl">Date Time</div> 
        <input type="text" class="inputDate" id="ord_out_date" />
        <div class="infoHolder dateTime" style="display:none;">
            <div class="infoHolderContent">
                <div id="datepicker"></div>
                <div class="calendarInfoBox"></div>
            </div>                       
        </div>
        <div class="calendarTxt" style="display: none;"></div>  
    </div>
    <div class="ref">
        <div class="lbl">Reference  </div>
        <input id="ord_out_id" type="text" class="refInput" />
    </div>
    <div class="divSup">
        <div class="lbl">Supplier  </div>
        <select class="input" id="prod_sup_id">
        <option value="">Select your supplier</option>
        <?php
            foreach($sup as $item){
                echo "<option value=\"".$item["sup_id"]."\">".$item["sup_name"]."</option>";
            }                
        ?>
        </select>
    </div>
    <div class="clear"></div>
    <table class="tab">
        <tr>
            <td class="lbl">Product</td> 
            <td class="lbl" style="width:330px;">Description</td>
            <td class="lbl">Quantity</td>
            <td class="lbl">Price</td>
            <td class="lbl">Total</td>
            <td></td>
        </tr>
        <tr>
            <td>
                <select id="prod_id" class="lblInput" type="text" >
                    <option value="Select">Select Product</option>
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
            <td><input id="prod_desc" class="lblInput" type="text" style="width:330px;" readonly /></td>
            <td><input id="order_out_det_qty" class="lblInput" type="text" /></td>
            <td><input id="prod_vend_id" class="lblInput" type="text" readonly /></td>
            <td>
                <input id="total" class="lblInput" type="text" value="0.00" readonly/>
            </td>
        </tr>
    </table>
    
    
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
