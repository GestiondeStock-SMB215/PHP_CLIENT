<?php
    $acl = 1;
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>

<div id="cat">
    <form name="category" method="POST" action="add.php">
        <div class="name" style="font-weight:bold; font-size:25px;">CATEGORY</div>
        <div id="cat_details" style="margin-left:250px;margin-top:20px;border: 2px solid #cbcbcb;width:806px;">
        <div id="cat_id" >
            <input type="hidden" id=".$cat_id."/>
        </div>
        <div id="cat_name">
        Name: <input type="text" id="cat_name"/>
        Description: <input type="text" id="description"size="80px;"/>
        </div>
            <div id="short_name">
                Short Name: <input type="text" id="shortname" readonly/>
            </div>
            <div id="cancel">
                <input type="RESET" value="CANCEL">
                <input type="Submit" value="SAVE">
            </div>
        </div>
            
    </form>
</div>    
<script langage="javascript">
        $("#description").keyup(function(){
    $("#shortname").val($(this).val().substring(0,10));
});
</script>