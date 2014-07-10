<?php
if(isset($_GET["trans_id"])){
    $trans_id = $_GET["trans_id"];
}else{
    echo "No trans_id";
    //header("location:/error.php?id_err=1");
}

$fileLoc = $_SERVER["DOCUMENT_ROOT"]."/tracking/log/log-$trans_id.txt";
if(file_exists($fileLoc)){
    $coords = array();
    $content = file_get_contents($fileLoc);
    $lines = explode("\r\n",$content);
//    echo $lines[3];
    foreach ($lines as $line){
        $values = explode(",", $line);
        if(count($values) === 3){  // coord
            $coords[] = "[".$values[1].",".$values[2]."]";
        }else if(count($values) === 2){  // end Date + EOF
            $coords[]="Truck begin<br>";
        }else if (count($values) === 1){ //start Date
            $coords[]="Truck still in the warehouse<br>";
        }else{
            die("error");
        }
    }
}else{
    echo "No logs for this trans_id";
    //header("location:/error.php?err_id=2");
}
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
    <script>
        var interval = null;
        function getFromServer(){
            $.get( "read.php?track_id=<?= $trans_id?>", function( data ) {
                $( "#content" ).append( data );
                if (data.split(",")[1] == -1){
                    stopinterval();
                }
            });
        }
        $(document).ready(function(){
            playinterval();
        });
        function playinterval(){
            getFromServer(); 
            interval = setInterval(function(){getFromServer();},1000); 
            return false;
        }

        function stopinterval(){
            clearInterval(interval); 
            return false;
        }        
    </script>
    <div id="content">
        <?php 
        foreach($coords as $coord){
            echo"$coord<br>";
        }
        ?>
    </div>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>