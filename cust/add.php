<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/header.inc.php";
    
     function addCustomer($cust_id,$cust_comp,$cust_name,$cust_title,$cust_add_1,$cust_add_2,$cust_city,$cust_cnt_id,
                        $cust_tel_1,$cust_tel_2,$cust_fax,$cust_email,$cust_site,$cust_logo){
        
        $cust_id = mysql_escape_mimic($cust_id);
        $cust_comp = mysql_escape_mimic($cust_comp);
        $cust_name = mysql_escape_mimic($cust_name);
        $cust_title= mysql_escape_mimic($cust_title);
        $cust_add_1 = mysql_escape_mimic($cust_add_1);
        $cust_add_2 = mysql_escape_mimic($cust_add_2);
        $cust_city = mysql_escape_mimic($cust_city);
        $cust_cnt_id = mysql_escape_mimic($cust_cnt_id);
        $cust_tel_1 = mysql_escape_mimic($cust_tel_1);
        $cust_tel_2 = mysql_escape_mimic($cust_tel_2);
        $cust_fax = mysql_escape_mimic($cust_fax);
        $cust_email = mysql_escape_mimic($cust_email);
        $cust_site = mysql_escape_mimic($cust_site);
        $cust_logo = mysql_escape_mimic($cust_logo);
        
        
        $cust_id = $_POST["cust_id"];
        $cust_comp = $_POST["cust_comp"];
        $cust_name = $_POST["cust_name"];
        $cust_title = $_POST["cust_title"];
        $cust_add_1 = $_POST["cust_add_1"];
        $cust_add_2 = $_POST["cust_add_2"];
        $cust_city = $_POST["cust_city"];
        $cust_cnt_id = $_POST["cust_cnt_id"];
        $cust_tel_1 = $_POST["cust_tel_1"];
        $cust_tel_2 = $_POST["cust_tel_2"];
        $cust_fax = $_POST["cust_fax"];
        $cust_email = $_POST["cust_email"];
        $cust_site = $_POST["cust_site"];
        $cust_logo = $_POST["cust_logo"];
        
        global $wsdl;
        set_time_limit(0);
        $response= $wsdl->addCustomer(array("cust_comp"=>$cust_comp,"cust_name"=>$cust_name,"cust_title"=>$cust_title,
                                            "cust_add_1"=>$cust_add_1,"cust_add_2"=>$cust_add_2,"cust_city"=>$cust_city,
                                            "cust_cnt_id"=>$cust_cnt_id,"cust_tel_1"=>$cust_tel_1,"cust_tel_2"=>$cust_tel_2,
                                            "cust_fax"=>$cust_fax,"cust_email"=>$cust_email,"cust_site"=>$cust_site,
                                            "cust_logo"=>$cust_logo));            
        
        foreach($response as $item){
        }
    }
     
?>

<form id="registerForm" action="show.php" method="POST">
    <div class="registerContainer">
        <h1>CUSTOMER</h1>
        <div class="lbl">Company:
            <input type="text" class="input" id="cust_comp"/></div>

        <div class="lbl">Name:
            <input type="text" class="input" id="cust_name" /></div>

        <div class="lbl">Address 1:
            <input type="text" class="input" id="cust_add_1" /></div>
            
        <div class="lbl">Address 2:
            <input type="text" class="input" id="cust_add_2" /></div>

        <div class="lbl">City:
            <input type="text" class="input" id="cust_city" /></div>

        <div class="lbl">Country:
            <select class="input" id="bra_cnt_id">
            <option value="">Please choose</option>
            <?= getCountries(); ?>
            </select>
        </div>

        <div class="lbl">Tel 1:
            <input type="text" class="input" id="cust_tel_1" /></div>
            
        <div class="lbl">Tel 2:
            <input type="text" class="input" id="cust_tel_2" /></div>
            
            <div class="lbl">Fax:
            <input type="text" class="input" id="cust_fax" /></div>
            
            <div class="lbl">Email:
            <input type="text" class="input" id="cust_email" /></div>
            
             <div class="lbl">Site:
             <input type="text" class="input" id="cust_site" /></div>
            
            <div class="lbl">
        <input id="btnRegister" class="btnRegister" name="reset" type="reset" value="CANCEL" style="float:left;"/>
        <input id="btnRegister" class="btnRegister" type="submit" value="SAVE"/>
           </div>
        </div>        
           
        <div class="loader"></div>
        <div class="lblMsg" id="lblMsg"></div>

</form>
<?php
addCustomer($cust_id,$cust_comp,$cust_name,$cust_title,$cust_add_1,$cust_add_2,$cust_city,$cust_cnt_id,
                        $cust_tel_1,$cust_tel_2,$cust_fax,$cust_email,$cust_site,$cust_logo);
    require_once $_SERVER["DOCUMENT_ROOT"]."/resources/footer.inc.php";
?>

