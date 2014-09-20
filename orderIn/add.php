<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<script type="text/javascript" src="../resources/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="../resources/js/jquery.ui.datepicker.js"></script>
<link href="../resources/css/jquery.ui.datepicker.css" rel="stylesheet" /> 

<div class="orderInContainer">
    <div class="txtInputDate">
        <div class="lbl">Date Time</div>  
        <div class="calendarTxt lblInput" ></div>         
        <div class="infoHolder dateTime" style="display:none;">
            <div class="infoHolderContent">
                <div id="datepicker"></div>
                <div class="calendarInfoBox"></div>
            </div>                       
        </div>
    </div>
    <div class="clear"></div>
    <div class="txtInput">
        <div class="lbl">Product</div>
        <input id="" class="lblInput" type="text" />
    </div>
    <div class="txtInput">
        <div class="lbl">Description</div>
        <input id="" class="lblInput" type="text" />
    </div>
    <div class="txtInput">
        <div class="lbl">Quantity</div>
        <input id="" class="lblInput" type="text" />
    </div>
    <div class="txtInput">
        <div class="lbl">Price</div>
        <input id="" class="lblInput" type="text" />
    </div>
    <div class="txtInput">
        <div class="lbl">Total</div>
        <input id="" class="lblInput" type="text" />
    </div>
    <input id="btnRegister" class="btnRegister" type="button" type="button" value="Register" />
    <input id="" class="btnRegister" name="Back" type="button" value="Cancel" onclick="javascript=window.location.href='show.php'" />        
    <div class="loader"></div>
    <div class="lblMsg" id="lblMsg"></div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $(".calendarTxt").html($.datepicker.formatDate('dd/MM/yy', new Date()));

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
            $(".calendarTxt").html($.datepicker.formatDate("dd/MM/yy", new Date(dd)));
            $(".calendarInfoBox").css("left", (position.left + 35) + 'px');
            $(".calendarInfoBox").css("top", (position.top - 7) + 'px');
            $("#dateLanguage").html(ddd);
        });
        
    });
     

</script>         
<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
