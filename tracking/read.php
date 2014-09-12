<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";
if(isset($_GET["track_id"])){
    $track_id = $_GET["track_id"];
}else{
    die("no ID 7illll");
}

$fileLoc = "log/log-$track_id.txt";
if(file_exists($fileLoc)){
    echo tailCustom($fileLoc)."<br>";
}else{
    echo "abcd";
}
?>