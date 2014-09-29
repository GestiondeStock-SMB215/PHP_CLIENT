<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
$product = readObj("Product", "prod_id", "-1"); 
    $customer = readObj("Customer", "cust_id", "-1");
?>
<script type="text/javascript" src="../resources/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="../resources/js/jquery.ui.datepicker.js"></script>
<link href="../resources/css/jquery.ui.datepicker.css" rel="stylesheet" /> 

<!--<script>
    $(document).ready(function(){
        
    });
   
</script>-->
<div class="orderInContainer">   
    <div class="title">Order In </div>
    <div class="chooseDate">
        <div class="lbl">Date Time</div> 
        <input type="text" class="inputDate" id="ord_in_date" />
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
        <input id="ord_in_id" type="text" class="refInput" readonly value="<?=getNextId("product", "prod_id")?>"/>
    </div>
    <div class="divSup">
        <div class="lbl">Customer  </div>
        <input id="cust_name" type="text" />
        <input id="order_in_cust_id" type="text" />
<!--        <select class="input" id="prod_cust_id">
        <option value="">Select your supplier</option>
        <?php
//            foreach($customer as $cust){
//                echo "<option value=\"".$cust["cust_id"]."\">".$cust["cust_name"]."</option>";
//            }                
        ?>
        </select>-->
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
                <input id="prod_id" class="lblInput" type="text" >
                    
            </td>
            <td><input id="prod_desc" class="lblInput" type="text" style="width:330px;" readonly /></td>
            <td><input id="order_in_det_qty" class="lblInput" type="text" /></td>
            <td><input id="prod_vend_id" class="lblInput" type="text" readonly /></td>
            <td>
                <input id="total" class="lblInput" type="text" value="0.00" readonly/>
            </td>
        </tr>
    </table>
    
    
    <div class="txtInput" style="height:100px;">
        <input id="" class="btnRegister" name="Back" type="button" value="Cancel" onclick="javascript=window.location.href='show.php'" />        
        
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>
    </div>
</div>

<div id="order"></div>

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
                             $("#order_in_det_qty").val("0"); 
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
        $(".calendarTxt").html($.datepicker.formatDate('yy-mm-dd', new Date()));
        $("#ord_in_date").val($.datepicker.formatDate("yy-mm-dd", new Date()));

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
            $(".calendarTxt").html($.datepicker.formatDate("yy-mm-dd", new Date(dd)));
            $("#ord_in_date").val($.datepicker.formatDate("yy-mm-dd", new Date(dd)));
            $(".calendarInfoBox").css("left", (position.left + 35) + 'px');
            $(".calendarInfoBox").css("top", (position.top - 7) + 'px');
            $("#dateLanguage").html(ddd);
        });
        
        $("#ord_in_date").click(function(){
            $(".infoHolder").slideToggle();
        });
        
        $("#order_in_det_qty").blur(function(){
            var qty = $("#order_in_det_qty").val();  
            q = parseInt(qty,10);
            $("#total").val(Calc(q));  
        });
        
        $("#btnAdd").click(function(){
          
        }); 
        
        $("#cust_name").keyup(function(){
            var cust_name = $("#cust_name").val();
            wantedData = {cust_name: cust_name};
            $.ajax({
                type         : "POST",
                url          : "/resources/ajax.php?func=getCustIdByName",
                data         : wantedData,
                cache        : false,
                dataType     : "json",
                success      : function(result){
                    console.log(result.cust_name);
                    $("#order_in_cust_id").val(result.cust_name+" - "+result.cust_id);
                }
            });
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

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
