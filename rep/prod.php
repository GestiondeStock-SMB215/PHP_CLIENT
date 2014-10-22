<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>

<script>
    $(document).ready(function(){
        var url = document.URL;
        var getSku = url.split('prod_sku=');
        var prod_sku = getSku[1];

       getProdIdBySku(prod_sku);  
    });
</script>

<div class="searchByProduct">
    <div class="title">Product Search</div>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>            
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
