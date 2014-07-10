<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/lib.inc.php";
    
    $time = getDT();

    if(isset($_GET["trans_id"]) && $_GET["trans_id"]!="" && is_numeric($_GET["trans_id"])){
        $trans_id = $_GET["trans_id"];
    }
    if(checkTrackingIdValidation($trans_id)){
        if(isset($_GET['tracker']) && $_GET['tracker']!=''){
            if($_GET['tracker']=="start"){
                $fp = fopen("log/log-$trans_id.txt","a+");
                fwrite($fp,$time."\r\n");
                fclose($fp);
                echo "Start <br>";
            }else{
                if($_GET['tracker']=="stop"){
                    $fp = fopen("log/log-$trans_id.txt","a+");
                    fwrite($fp, "$time,-1\r\n");
                    fclose($fp);
                    echo "Stop <br>";
                }        
            }
        }else{
            if(isset($_GET['lon']) && $_GET['lon']!='' && isset($_GET['lat']) && $_GET['lat']!=''){
                $lat = $_GET['lat'];
                $lon = $_GET['lon'];
                $fp = fopen("log/log-$trans_id.txt","a+");
                fwrite($fp, "$time,$lon,$lat\r\n");
                fclose($fp);
                echo $_GET["trans_id"].",".$_GET["lat"].",".$_GET["lon"]."<br>";
            }
        }
    }
    else{
        echo "Failed";
    }
?>