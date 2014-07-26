<?php
    $acl = 4;
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<script>
$(document).ready(function(){  
    $('.welcome').click(function () {
        $('.pnlLogin').slideToggle("slide");
    });
    
    $('.title').click(function(){
        var id = $(this).html();
        $('.sub').slideUp(); 
        $('#' + id).slideToggle();        
    });
});
</script>  
<div class="main">
    
</div>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
