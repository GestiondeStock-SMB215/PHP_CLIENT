<?php
if(isset($_GET["trans_id"])){
    $trans_id = $_GET["trans_id"];
}else{
    echo "No trans_id";
    //header("location:/error.php?id_err=1");
}

$fileLoc = $_SERVER["DOCUMENT_ROOT"]."/gss/GSS_PHP_CLIENT/tracking/log/log-$trans_id.txt";
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
    require_once $_SERVER["DOCUMENT_ROOT"]."/gss/GSS_PHP_CLIENT/resources/header.inc.php";
?>
    <style type="text/css">
      #map {
        width: 700px;
        height: 600px;
        margin-top: 10px;
      }
    </style>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script>
        var interval = null;
        var coords = [
            new google.maps.LatLng(33.9132316,35.5890649),
            new google.maps.LatLng(33.9166239,35.5871337),
            new google.maps.LatLng(33.9242592,35.5881776),
            new google.maps.LatLng(33.9329343,35.5898191),
            new google.maps.LatLng(33.9423606,35.5917074),
            new google.maps.LatLng(33.9514588,35.5928607),
            new google.maps.LatLng(33.9548139,35.5956019),
            new google.maps.LatLng(33.9568176,35.6002121),
            new google.maps.LatLng(33.9611774,35.604019),
            new google.maps.LatLng(33.9642707,35.6059663),
            new google.maps.LatLng(33.9666482,35.6074107),
            new google.maps.LatLng(33.970535,35.6090102),
            new google.maps.LatLng(33.9724413,35.6106705),
            new google.maps.LatLng(33.9737952,35.6118712)
        ];
        var i =0;
        var path = [new google.maps.LatLng(33.9152082,35.5976909)];
        function getFromServer(){
//            $.get( "read.php?track_id=<?= $trans_id?>", function( data ) {
//                //$( "#content" ).append( data );
//                var info = data.split(',');
//                if(info.length == 3){
//                    path.push(new google.maps.LatLng(info[1],info[2]));
//                    draw();
//                }
//                if (data.split(",")[1] == -1){
//                    stopinterval();
//                }
//            });
            path.push(coords[i]);
            draw();
            console.log(i);
            if(i<coords.length){i++;}else{stopinterval();}
        }
        $(document).ready(function(){
            playinterval();
            draw();
        });
        function playinterval(){
            getFromServer(); 
            interval = setInterval(function(){getFromServer();},3000); 
            return false;
        }

        function stopinterval(){
            clearInterval(interval); 
            return false;
        }
        
	function draw(){
		//path.push(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
		
		var myOptions = {
            zoom : 16,
            center : path[0],
            mapTypeId : google.maps.MapTypeId.ROADMAP
          }
          var map = new google.maps.Map(document.getElementById("map"), myOptions); 
          // Create the array that will be used to fit the view to the points range and
          // place the markers to the polyline's points
          var latLngBounds = new google.maps.LatLngBounds();
          for(var i = 0; i < path.length; i++) {
            latLngBounds.extend(path[i]);
            // Place the marker
            new google.maps.Marker({
              map: map,
              position: path[i],
              title: "Point " + (i + 1)
            });
          }
          // Creates the polyline object
          var polyline = new google.maps.Polyline({
            map: map,
            path: path,
            strokeColor: '#0000FF',
            strokeOpacity: 0.7,
            strokeWeight: 1
          });
          // Fit the bounds of the generated points
          map.fitBounds(latLngBounds);
	}
    </script>
    <div id="content">
        <?php 
//        foreach($coords as $coord){
//            echo"$coord<br>";
//        }
        ?>
    </div>
    <div id="map"></div>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/gss/GSS_PHP_CLIENT/resources/footer.inc.php";
?>