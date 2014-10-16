<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
if(!isset($_GET["ord_in_id"])){
    header("location:show.php");
}

getProdSession();
getCustSession();

?>

<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>