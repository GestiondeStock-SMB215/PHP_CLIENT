<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    if(!isset($_GET["err"])){
        header("location:/index.php");
    }
    $errorMsg = array(
        1=>"Vous n'avez pas l'authorization d'accédez à cette page",
        2=>"Erreur 2"
    );
?>

    <div class="imgError">
        <img src="resources/img/error.jpg" alt="" style="margin: 8% auto auto 38%;"/>
    </div>
    <div class="errorMsg">
        <h3><?= $errorMsg[$_GET["err"]] ?></h3>
    </div>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>