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

<form>
    <div class="imgError">
        <img src="" alt="" />
    </div>
    <div class="errorMsg">
        <?= $errorMsg[$_GET["err"]] ?>
    </div>
</form>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>