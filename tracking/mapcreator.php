<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/gss/GSS_PHP_CLIENT/resources/header.inc.php";
?>
<script>
    var interval;
    var i = 0;
    var coord = [
        [1,33.9152082,35.5976909], //0 - i=1
        [1,33.9132316,35.5890649],
        [1,33.9166239,35.5871337],
        [1,33.9242592,35.5881776],
        [1,33.9329343,35.5898191],
        [1,33.9423606,35.5917074],
        [1,33.9514588,35.5928607],
        [1,33.9548139,35.5956019],
        [1,33.9568176,35.6002121],
        [1,33.9611774,35.604019],
        [1,33.9642707,35.6059663],
        [1,33.9666482,35.6074107],
        [1,33.970535,35.6090102],
        [1,33.9724413,35.6106705],
        [1,33.9737952,35.6118712] //14 - i=15
    ];
    $(document).ready(function() {
        playinterval();   
    });
    function sendCoord(){   
        if(i==0){
            var trans_id = coord[i][0];
            $.ajax({
                url:"savecoord.php",
                type:"GET",
                data:{
                    tracker: "start",
                    trans_id : trans_id
                },
                success: function (jsonStr) {
                    $("#result").append(jsonStr);
                    i++;
                }
            });            
        }
        else{
            var trans_id = coord[i-1][0];
            var lat = coord[i-1][1];
            var lon = coord[i-1][2];
            $.ajax({
                url:"savecoord.php",
                type:"GET",
                data:{
                    lat: lat,
                    lon: lon,
                    trans_id : trans_id
                },
                success: function (jsonStr) {
                    $("#result").append(jsonStr);
                    i++;
                }
            });
            if(i==15){
                stopinterval();
                $.ajax({
                    url:"savecoord.php",
                    type:"GET",
                    data:{
                        tracker: "stop",
                        trans_id : trans_id
                    },
                    success: function (jsonStr) {
                        $("#result").append(jsonStr);
                    }
                });
            }
        }
    }
    
    function playinterval(){
        sendCoord(); 
        interval = setInterval(function(){sendCoord();},1000); 
        return false;
    }

    function stopinterval(){
        clearInterval(interval); 
        return false;
    }
</script> 
<div id="result"></div>

<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/gss/GSS_PHP_CLIENT/resources/footer.inc.php";
?>