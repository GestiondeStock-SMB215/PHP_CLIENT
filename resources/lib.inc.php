<?php
    date_default_timezone_set("Asia/Beirut");
    
    function dbconnect(){
        $link = mysqli_connect("localhost","henryko_gss","[password]","gss", "3306") or die("Error " . mysqli_error($link));
        $sSQL= 'SET CHARACTER SET utf8'; 
        mysqli_query($link,$sSQL);
        return $link;
    }
    
    function getDT(){
        return date("Y-m-d H:i:s");
    }
    
    function getD(){
        return date("Y-m-d");
    }
    
    function checkTrackingIdValidation($trans_id){
//        $link   = dbconnect();
//        $query  = "SELECT `trans_status` FROM `transfert` WHERE `trans_id` = '$trans_id'";
//        $result = $link->query($query);
//        $row = mysqli_fetch_array($result);
//        if((count($row) == 0)||($row[0] != '2')){ //2 is the status of on road transfer so ready to track
//            return true;
//        }
//        else{
//            return false;
//        }
        return true;
    }
?>