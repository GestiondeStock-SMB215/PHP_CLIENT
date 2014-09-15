/*Map*/
$(document).ready(function () {
    var map, obj;
    var init = 0;
    var ib;
    var myOptions = {};
    initialize();
    markicons(map, obj, null);
          
});

function initialize() {
    var latlng = new google.maps.LatLng(33.9, 35.619843);
    var settings = {
        zoom: 8,
        center: latlng,
        mapTypeControl: true,
        mapTypeControlOptions: { style: google.maps.MapTypeControlStyle.DROPDOWN_MENU },
        navigationControl: true,
        navigationControlOptions: { style: google.maps.NavigationControlStyle.FULL },
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("locationMap"), settings);
}

function markicons(map, obj) {
    var boxText = document.createElement("div");
    boxText.style.cssText = "width:286px;height:226px;min-height:100px;padding:8px 10px;background:url(../img/map/infowindow_bg.png) no-repeat;background-position:initial initial;";

    var res = '<div id="infoBoxContainer"><div id="infoBoxDivTitle" style="color:#FFFFFF;font-size:25px;font-weight:bold;"></div><div id="infoBoxDivBranch" style="color:#231f20;font-size:14px;margin-top:20px;font-weight:bold;"></div><div class="contactInfoAttrTitle">Address</div><div class="contactInfoTxtStyle" id="infoBoxDivAddress"></div><div class="contactInfoAttrTitle">Details</div><div class="contactInfoTxtStyle" id="infoBoxDivPhone"></div></div>';
   
    $(boxText).append(res);

    var ltlng = new Array();

    /*Initialize the map*/
        var latlng = new google.maps.LatLng(33.8833, 35.5000); /*Center to Beirut*/
        var myOptions = {
            zoom: 8,
            center: latlng,
            mapTypeControl: true,
            mapTypeControlOptions: { style: google.maps.MapTypeControlStyle.DROPDOWN_MENU },
            navigationControl: true,
            navigationControlOptions: { style: google.maps.NavigationControlStyle.FULL },
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("locationMap"), myOptions);
}

function getDetails(details){
    var query = details.toLowerCase();
    var phoneIndex = query.indexOf('phone');
    var openingHoursIndex = query.indexOf('opening hours');
    var phone = details.substring(0, (openingHoursIndex - 1));
    var openingHours = details.substring(openingHoursIndex, query.length);
    var allDetails = phone+'</br>'+openingHours
    return allDetails;
}
