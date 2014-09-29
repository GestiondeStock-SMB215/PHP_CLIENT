<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
if(!isset($_SESSION['order_out_id'])){ 
    $_SESSION['order_out_id'] = 
        aeObj(
            "orderOut", 
            array(
                "ord_out_id"=>"-1",
                "ord_out_sup_id"=>"-1",
                "ord_out_date"=>  getDT(),
                "ord_out_del_date"=>"0000-00-00 00:00:00",
                "ord_out_status"=>"0"
            )
        )
    ;
} 
if(!isset($_SESSION['prod_list'])){ 
    $_SESSION['prod_list'] = 
        readObj(
            "Product", 
            "prod_id",
            "-1"
        )
    ;
} 


?>
<script type="text/javascript" src="/resources/js/jquery.ui.datepicker.js"></script>
<link href="/resources/css/jquery.ui.datepicker.css" rel="stylesheet" />                  
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
        $(".calendarTxt").html($.datepicker.formatDate('yy-mm-dd', new Date()));
        $("#ord_out_date").val($.datepicker.formatDate("yy-mm-dd", new Date()));

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
            $("#ord_out_date").val($.datepicker.formatDate("yy-mm-dd", new Date(dd)));
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
<script>
$(document).ready(function() {
    $('#example').dataTable({
        "iDisplayLength":5  
    });
});
</script>
<script>
    $(document).ready(function(){        
        $("#sup_name").keyup(function(){
            var sup_name = $("#sup_name").val();
            wantedData = {cust_name: cust_name};
            $.ajax({
                type         : "POST",
                url          : "/resources/ajax.php?func=getCustIdByName",
                data         : wantedData,
                cache        : false,
                dataType     : "json",
                success      : function(result){
                    console.log(result.sup_name);
                    
                    $("#order_out_sup_id").val(result.sup_name+" - "+result.sup_id);
                }
            });
        });
    });
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
        <input id="ord_out_id" type="text" class="refInput" value="<?=$_SESSION['order_out_id'];?>" readonly/>
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
                </select>
            </td>
            <td><input id="prod_desc" class="lblInput" type="text" style="width:330px;" readonly /></td>
            <td><input id="ord_out_det_qty" class="lblInput" type="text" /></td>
            <td><input id="prod_vend_id" class="lblInput" type="text" readonly /></td>
            <td>
                <input id="total" class="lblInput" type="text" value="0.00" readonly/>
            </td>
        </tr>
    </table>
    
     <!--datatable-->
    <div class="clear"></div>
<table width="100%"><tr><td><h3>Detail</h3></td><td align="right"><input type="button" value="Create" class="myButton" onclick="javascript:window.location.href='add.php'"/></td></tr></table>
<table id="example" class="display cell-border">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Unit price</th>
            <th>Total</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $objs = getOrderOutDetailByOrdOutId($_SESSION['order_out_id']);
            foreach($objs as $obj){
                echo "<tr>";
                foreach($_SESSION["prod_list"] as $prodItem){
                    if($obj["ord_out_det_prod_id"] == $prodItem["prod_id"]){
                        echo "<td>".$prodItem["prod_name"]."</td>";
                    }
                    
                }
                $qty = $obj["ord_out_det_qty"];
                echo "<td>".$obj["ord_out_det_qty"]."</td>";
                foreach($_SESSION["prod_list"] as $prodItem){
                    if($obj["ord_out_det_prod_id"] == $prodItem["prod_id"]){
                        $up = $prodItem["prod_vend_id"];
                        echo "<td>".$prodItem["prod_vend_id"]."</td>";
                    }
                }
                echo "<td>".($qty*$up)."</td>";
                echo "<td><a href=\"edit.php?ord_out_det_id=".$obj["ord_out_det_id"].""."\">Edit</a></td>";
                echo "<td><a href=\"delete.php?ord_out_det_id=".$obj["ord_out_det_id"]."\">Delete</a></td>";                
                echo "</tr>";
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Unit price</th>
            <th>Total</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </tfoot>    
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
