<?php
    $acl = 1;
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<form action="add.php">
    Branch Name: <input type="text" name="bra_name">
    <br>
    Branch Country: 
    <select name="bra_id">
        <option value="">Please choose</option>
        <?= getCountries()?>
    </select>
</form>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
