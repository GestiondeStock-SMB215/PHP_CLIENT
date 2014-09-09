<style>
    .global{width:400px;}
    
    .name{float:left;text-indent:50px;border:1px solid black;width:170px;font-size:18px;font-weight:bold}
    
    .desc{float:right;text-indent:60px;border:1px solid black;width:226px;font-size:18px;font-weight:bold}
     
    #global{height:150px;width:400px}
            
    #name{width:170px;border:1px solid black;}
    
    #desc{float:right;border:1px solid black;text-indent:60px;width:226px;height:20px;margin-top:-22px;}    
</style>
    <script>
    $("#check").click(function () {
        if($("#check").checked){
       deleteCategory();
   }
    });
    </script>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    
function getCategories(){
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->getCategories();
        echo "<div class='registerContainer' id='example'>".
             "<h3>CATEGORIES</h3>".
             "<div class='global'>".
             "<div class='name'>NAME</div>".
             "<div class='desc'>DESCRIPTION</div>";
        foreach($response as $result){
            
            foreach($result as $item){
                
                echo "<div id='global'>".  
                     "<div id='name'><input id='check' type='checkbox'/>$item->cat_name</div>".
                     "<div id='desc'>$item->cat_desc</div>";
               
            }
        }
        echo "</div></div></div>";
    }
    function deleteCategory(){
        global $wsdl;
        set_time_limit(0);
        $response = $wsdl->deleteCategory();
    
    }
    ?>
   <?php getCategories(); ?>
   