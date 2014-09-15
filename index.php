<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
?>
<div class="clear"></div>
<div class="mainPage">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTT6dLqL2eRw4eeQ42SvYPGYrTIdhYOCk&sensor=false"></script>
    <script type="text/javascript" src="resources/js/map.js"></script>

    <div class="dashboard">
        
    </div>
    <div class="locationMap">
        <div class="mainBox">
            <div class="mainBoxHeader">Location Map</div>
            <div class="mainBoxHeaderLine"></div>
            <div class="mainBoxContent">
                <div id="locationMapLoader"></div>
                <div id="locationMap"></div>
            </div>
        </div>
    </div>
</div>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>
