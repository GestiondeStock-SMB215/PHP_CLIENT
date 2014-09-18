function getUserByUsername() {
    user_username = $("#txtUsername").val();
    user_password = $("#txtPswd").val();

    if (user_password !== "" && user_password !== "") {
        wantedData = {user_username: user_username ,user_password: user_password };
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax.php?func=getUserByUsername",
            data         : wantedData,
            cache        : false,
            dataType     : "json",
            beforeSend   : function () {
                $('#lblMsgLogin').html("");
                $('#loginLoader').show();
            },
            complete: function () {
                $('#loginLoader').hide();
            },
            success      : function(result){
                console.log(result.msg);
                if (result.msg === "signedIn") {
                    
                    window.location.href = "index.php";
                }
                else{
                    $('#lblMsgLogin').html(result.msg);
                }               
           }
        });
    }
    else{
        $('#lblMsgLogin').html("Username and/or Password are required.");        
    }
}

function checkUserNameValidity() {
    user_username = $("#user_username").val();
    if (user_username !== "") {
        wantedData = {user_username: user_username};
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax.php?func=checkUserNameValidity",
            data         : wantedData,
            cache        : false,
            dataType     : "json",
            success      : function(result){
                console.log(result.msg);
                if(result.err == "1"){
                    $("#user_username").val('');
                    $("#user_username").focus();
                }
                $('#lblMsg').html(result.msg);
           }
        });
    }
}

function checkUserEmailValidity() {
    user_email = $("#user_email").val();
    if (user_email != "") {
        wantedData = {user_email: user_email};
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax.php?func=checkUserEmailValidity",
            data         : wantedData,
            cache        : false,
            dataType     : "json",
            success      : function(result){
                console.log(result.msg);
                if(result.err == "1"){
                    $("#user_email").val('');
                    $("#user_email").focus();
                }
                $('#lblMsg').html(result.msg);
           }
        });
    }
}

function addUser() {
    user_role_id = $("#user_role_id").val();
    user_name = $("#user_name").val();
    user_username = $("#user_username").val();
    user_password = $("#user_password").val();
    user_password_conf = $("#user_password_conf").val();
    user_email = $("#user_email").val();
    user_status = $("#user_status").val();
    wantedData = {user_role_id: user_role_id, user_name: user_name,
            user_username: user_username ,user_password: user_password, 
            user_email: user_email , user_status: user_status};
        
    if (user_role_id != "" && user_role_id != " ") {
        if (user_name != "" && user_name != " ") {
            if (user_username != "" && user_username != " ") {
                if (user_email != "" && user_email != " ") {
                    if (isValidEmailAddress(user_email) == true) {
                        if (user_password != "" && user_password != " ") {
                            if (user_password_conf != "" && user_password_conf != " ") {
                                if (identicPswd(user_password, user_password_conf) == true) {
                                    if (user_status != "" && user_status != " ") {
                                        $.ajax({
                                            type         : "POST",
                                            url          : "/resources/ajax.php?func=addUser",
                                            data         : wantedData,
                                            cache        : false,
                                            dataType     : "json",
                                            beforeSend   : function () {
                                                $('#lblMsg').html("");
                                                $('#loader').show();
                                            },
                                            complete: function () {
                                                $('#loader').hide();
                                            },
                                            success      : function(result){
                                                console.log(result.msg);
                                                if(result.msg == "1"){
                                                    $('#lblMsg').html("User has been added successfuly");
                                                }
                                                else{
                                                    $('#lblMsg').html("User has not been added. Please try again");
                                                }
                                            }
                                        });
                                    } else {
                                        $('#lblMsg').html("Please select your status");
                                    }
                                } else {
                                    $('#lblMsg').html("Please confirm your password correctly");
                                }
                            } else {
                                $('#lblMsg').html("Please confirm your password");
                            }
                        } else {
                            $('#lblMsg').html("Please fill your password");
                        }
                    } else {
                        $('#lblMsg').html("Please enter a valid email");
                    }
                } else {
                    $('#lblMsg').html("Please enter your email");
                }
            } else {
                $('#lblMsg').html("Please enter your username");
            }
        } else {
            $('#lblMsg').html("Please enter your name");
        }
    } else {
        $('#lblMsg').html("Please select your role");
    }
}


function editUser() {
    user_id = $("#user_id").val();
    user_role_id = $("#user_role_id").val();
    user_name = $("#user_name").val();
    user_username = $("#user_username").val();
    user_password = $("#user_password").val();
    user_password_conf = $("#user_password_conf").val();
    user_email = $("#user_email").val();
    user_status = $("#user_status").val();
    wantedData = {user_id:user_id,user_role_id: user_role_id, user_name: user_name,
            user_username: user_username ,user_password: user_password, 
            user_email: user_email , user_status: user_status};
        
    if (user_role_id != "" && user_role_id != " ") {
        if (user_name != "" && user_name != " ") {
            if (user_username != "" && user_username != " ") {
                if (user_email != "" && user_email != " ") {
                    if (isValidEmailAddress(user_email) == true) {
//                        if (user_password != "" && user_password != " ") {
//                            if (user_password_conf != "" && user_password_conf != " ") {
                                if (identicPswd(user_password, user_password_conf) == true) {
                                    if (user_status != "" && user_status != " ") {
                                        $.ajax({
                                            type         : "POST",
                                            url          : "/resources/ajax.php?func=editUser",
                                            data         : wantedData,
                                            cache        : false,
                                            dataType     : "json",
                                            beforeSend   : function () {
                                                $('#lblMsg').html("");
                                                $('#loader').show();
                                            },
                                            complete: function () {
                                                $('#loader').hide();
                                            },
                                            success      : function(result){
                                                console.log(result.msg);
                                                if(result.msg == "1"){
                                                    $('#lblMsg').html("User has been edited successfuly");
                                                }
                                                else{
                                                    $('#lblMsg').html("User has not been edited. Please try again");
                                                }
                                            }
                                        });
                                    } else {
                                        $('#lblMsg').html("Please select your status");
                                    }
                                } else {
                                    $('#lblMsg').html("Please confirm your password correctly");
                                }
//                            } else {
//                                $('#lblMsg').html("Please confirm your password");
//                            }
//                        } else {
//                            $('#lblMsg').html("Please fill your password");
//                        }
                    } else {
                        $('#lblMsg').html("Please enter a valid email");
                    }
                } else {
                    $('#lblMsg').html("Please enter your email");
                }
            } else {
                $('#lblMsg').html("Please enter your username");
            }
        } else {
            $('#lblMsg').html("Please enter your name");
        }
    } else {
        $('#lblMsg').html("Please select your role");
    }
}

function identicPswd(pswd, confPswd) {
    if (pswd != confPswd)
        return false;
    else
        return true;
}

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/);
    return pattern.test(emailAddress);
}

function isValidNumber(phone) {
    //var pattern = new RegExp(/^\+\d+$/);
    var pattern = new RegExp(/^\d+$/);
    return pattern.test(phone);
}

function addPage(){
    page_parent_id  = $("#page_parent_id").val();
    page_name       = $("#page_name").val();
    page_url        = $("#page_url").val();
    page_acl        = $("#page_acl").val();
    page_in_menu    = $("#page_in_menu").is(":checked");
    page_order      = $("#page_order").val();
    if(page_in_menu){page_in_menu = 1;}else{page_in_menu = 0;}
      
    wantedData = {page_parent_id:page_parent_id, page_name:page_name, page_url:page_url, 
            page_acl: page_acl, page_in_menu:page_in_menu, page_order:page_order};
    if(page_name != "" && page_parent_id != "" && page_acl != ""){
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax.php?func=addPage",
            data         : wantedData,
            cache        : false,
            dataType     : "json",
            beforeSend   : function () {
                $('#lblMsg').html("");
                $('#loader').show();
            },
            complete: function () {
                $('#loader').hide();
            },
            success      : function(result){
                
                console.log(result.msg);
                if(result.msg == "1"){
                    $('#lblMsg').html("Page has been added successfuly");
                }
                else{
                    $('#lblMsg').html("Page has not been added. It could be already exist");
                }
                
            }
        });
    }
    else{
        $('#lblMsg').html("Please fill in all required fields");
    }
}

function addBranch(){   
    bra_name        = $("#bra_name").val();
    bra_cnt_id      = $("#bra_cnt_id").val();
    bra_city        = $("#bra_city").val();
    bra_add_str     = $("#bra_add_str").val();
    bra_add_1       = $("#bra_add_1").val();
    bra_tel_1       = $("#bra_tel_1").val();
    bra_tel_2       = $("#bra_tel_2").val();
    bra_fax         = $("#bra_fax").val();
    bra_email       = $("#bra_email").val();
    
    wantedData = {
        bra_name:bra_name, 
        bra_cnt_id:bra_cnt_id, 
        bra_city:bra_city,
        bra_add_str:bra_add_str, 
        bra_add_1:bra_add_1, 
        bra_tel_1:bra_tel_1,
        bra_tel_2:bra_tel_2, 
        bra_fax:bra_fax, 
        bra_email:bra_email
    };
        
    if(bra_name != "" && bra_cnt_id != "" && bra_city != "" && bra_add_1 != "" && bra_tel_1 != ""){
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax.php?func=addBranch",
            data         : wantedData,
            cache        : false,
            dataType     : "json",
            beforeSend   : function () {
                $('#lblMsg').html("");
                $('#loader').show();
            },
            complete: function () {
                    $('#loader').hide();
            },
            success      : function(result){
                console.log(result.msg);
                if(result.msg == "1"){
                    $('#lblMsg').html("Branch has been added successfuly");
                }
                else{
                    $('#lblMsg').html("Branch has not been added.");
                }
                
            }
        });
    }
    else{
        $('#lblMsg').html("Please fill in all required fields");
    }
}
function editBranch(){
    bra_id          = $("#bra_id").val();
    bra_name        = $("#bra_name").val();
    bra_cnt_id      = $("#bra_cnt_id").val();
    bra_city        = $("#bra_city").val();
    bra_add_str     = $("#bra_add_str").val();
    bra_add_1       = $("#bra_add_1").val();
    bra_tel_1       = $("#bra_tel_1").val();
    bra_tel_2       = $("#bra_tel_2").val();
    bra_fax         = $("#bra_fax").val();
    bra_email       = $("#bra_email").val();

    wantedData = {
        bra_id:bra_id,
        bra_name:bra_name, 
        bra_cnt_id:bra_cnt_id, 
        bra_city:bra_city,
        bra_add_str:bra_add_str, 
        bra_add_1:bra_add_1, 
        bra_tel_1:bra_tel_1,
        bra_tel_2:bra_tel_2, 
        bra_fax:bra_fax, 
        bra_email:bra_email
    };

    if(bra_name != "" && bra_cnt_id != "" && bra_city != "" && bra_add_1 != "" && bra_tel_1 != ""){
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax.php?func=editBranch",
            data         : wantedData,
            cache        : false,
            dataType     : "json",
            beforeSend   : function () {
                $('#lblMsg').html("");
                $('#loader').show();
            },
            complete: function () {
                $('#loader').hide();
            },
            success      : function(result){
                console.log(result.msg);
                if(result.msg == "1"){
                    $('#lblMsg').html("Branch has been edited successfuly");
                }
                else{
                    $('#lblMsg').html("Branch has not been edited.");
                }
                
            }
        });
    }
    else{
        $('#lblMsg').html("Please fill in all required fields");
    }
}

function addCategory(){
    
    cat_name        = $("#cat_name").val();
    cat_desc        = $("#cat_desc").val();

    wantedData = {cat_name:cat_name, cat_desc:cat_desc};
        
    if(cat_name != "" && cat_desc != "" ){
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax.php?func=addCategory",
            data         : wantedData,
            cache        : false,
            dataType     : "json",
            beforeSend   : function () {
                $('#lblMsg').html("");
                $('#loader').show();
            },
            complete: function () {
                $('#loader').hide();
            },
            success      : function(result){
                
                console.log(result.msg);
                if(result.msg == "1"){
                    $('#lblMsg').html("Category has been added successfuly");
                }
                else{
                    $('#lblMsg').html("Category has not been added.");
                }
                
            }
        });
    }
    else{
        $('#lblMsg').html("Please fill in all required fields");
    }
}
function editCategory(){
    
    cat_id          = $("#cat_id").val();
    cat_name        = $("#cat_name").val();
    cat_desc        = $("#cat_desc").val();

    wantedData = {cat_id:cat_id,cat_name:cat_name, cat_desc:cat_desc};
        
    if(cat_name != "" && cat_desc != "" ){
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax.php?func=editCategory",
            data         : wantedData,
            cache        : false,
            dataType     : "json",
            beforeSend   : function () {
                $('#lblMsg').html("");
                $('#loader').show();
            },
            complete: function () {
                $('#loader').hide();
            },
            success      : function(result){
                
                console.log(result.msg);
                if(result.msg == "1"){
                    $('#lblMsg').html("Category has been edited successfuly");
                }
                else{
                    $('#lblMsg').html("Category has not been edited.");
                }
                
            }
        });
    }
    else{
        $('#lblMsg').html("Please fill in all required fields");
    }
}

function addCustomer(){
    cust_comp          = $("#cust_comp").val();
    cust_name          = $("#cust_name").val();
    cust_title         = $("#cust_title").val();
    cust_add_1         = $("#cust_add_1").val();
    cust_add_2         = $("#cust_add_2").val();
    cust_city          = $("#cust_city").val();
    cust_cnt_id        = $("#cust_cnt_id").val();
    cust_tel_1         = $("#cust_tel_1").val();
    cust_tel_2         = $("#cust_tel_2").val();
    cust_fax           = $("#cust_fax").val();
    cust_email         = $("#cust_email").val();
    cust_site          = $("#cust_site").val();
 

    wantedData = {cust_comp:cust_comp, cust_name:cust_name, cust_title:cust_title,
                  cust_add_1:cust_add_1, cust_add_2:cust_add_2, cust_city:cust_city,
                  cust_cnt_id:cust_cnt_id, cust_tel_1:cust_tel_1, cust_tel_2:cust_tel_2,
                  cust_fax:cust_fax, cust_email:cust_email, cust_site:cust_site };
        
    if(cust_comp != "" && cust_title != "" && cust_name != "" && cust_add_1 != "" && cust_cnt_id != "" && cust_tel_1 != "" && cust_email != ""){
       $.ajax({
            type         : "POST",
            url          : "/resources/ajax.php?func=addCustomer",
            data         : wantedData,
            cache        : false,
            dataType     : "json",
            beforeSend   : function () {
                $('#lblMsg').html("");
                $('#loader').show();
            },
            complete: function () {
                $('#loader').hide();
            },
            success      : function(result){
                
                console.log(result.msg);
                if(result.msg == "1"){
                    $('#lblMsg').html("Customer has been added successfuly");
                }
                else{
                    $('#lblMsg').html("Customer has not been added.");
                }
                
            }
        });
    }
    else{
        $('#lblMsg').html("Please fill in all required fields");
    }
}
function editCustomer(){
    cust_id            = $("#cust_id").val();
    cust_comp          = $("#cust_comp").val();
    cust_name          = $("#cust_name").val();
    cust_title         = $("#cust_title").val();
    cust_add_1         = $("#cust_add_1").val();
    cust_add_2         = $("#cust_add_2").val();
    cust_city          = $("#cust_city").val();
    cust_cnt_id        = $("#cust_cnt_id").val();
    cust_tel_1         = $("#cust_tel_1").val();
    cust_tel_2         = $("#cust_tel_2").val();
    cust_fax           = $("#cust_fax").val();
    cust_email         = $("#cust_email").val();
    cust_site          = $("#cust_site").val();
 

    wantedData = {cust_id:cust_id,cust_comp:cust_comp, cust_name:cust_name, cust_title:cust_title,
                  cust_add_1:cust_add_1, cust_add_2:cust_add_2, cust_city:cust_city,
                  cust_cnt_id:cust_cnt_id, cust_tel_1:cust_tel_1, cust_tel_2:cust_tel_2,
                  cust_fax:cust_fax, cust_email:cust_email, cust_site:cust_site };
        
    if(cust_comp != "" && cust_name != "" && cust_add_1 != "" && cust_cnt_id != "" && cust_tel_1 != "" && cust_email != ""){
       $.ajax({
            type         : "POST",
            url          : "/resources/ajax.php?func=editCustomer",
            data         : wantedData,
            cache        : false,
            dataType     : "json",
            beforeSend   : function () {
                $('#lblMsg').html("");
                $('#loader').show();
            },
            complete: function () {
                $('#loader').hide();
            },
            success      : function(result){
                
                console.log(result.msg);
                if(result.msg == "1"){
                    $('#lblMsg').html("Customer has been edited successfuly");
                }
                else{
                    $('#lblMsg').html("Customer has not been edited.");
                }
                
            }
        });
    }
    else{
        $('#lblMsg').html("Please fill in all required fields");
    }
}
function addProduct(){
    prod_cat_id       = $("#prod_cat_id").val();
    prod_sku          = $("#prod_sku").val();
    prod_upc          = $("#prod_upc").val();
    prod_name         = $("#prod_name").val();
    prod_desc         = $("#prod_desc").val();
//  prod_qty          = $("#prod_qty").val();
    prod_color        = $("#prod_color").val();
    prod_size         = $("#prod_size").val();
    prod_weight       = $("#prod_weight").val();
    prod_sup_id       = $("#prod_sup_id").val();
    prod_status       = $("#prod_status").val();

    wantedData = {
        prod_cat_id:prod_cat_id,
        prod_sku:prod_sku,
        prod_upc:prod_upc,
        prod_name:prod_name,
        prod_desc:prod_desc,
//      prod_qty:prod_qty,
        prod_color:prod_color,
        prod_size:prod_size,
        prod_weight:prod_weight,
        prod_sup_id:prod_sup_id,
        prod_status:prod_status};
        
    if(prod_cat_id != "" && prod_name != "" && prod_sup_id != ""){
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax.php?func=addProduct",
            data         : wantedData,
            cache        : false,
            dataType     : "json",
            beforeSend   : function () {
                $('#lblMsg').html("");
                $('#loader').show();
            },
            complete: function () {
                $('#loader').hide();
            },
            success      : function(result){
                console.log(result.msg);
                if(result.msg == "1"){
                    $('#lblMsg').html("Supplier has been added successfuly");
                }
                else{
                    $('#lblMsg').html("Supplier has not been added.");
                }
                
            }
        });
    }
    else{
        $('#lblMsg').html("Please fill in all required fields");
    }
}
function editProduct(){
    prod_id           = $("#prod_id").val();
    prod_cat_id       = $("#prod_cat_id").val();
    prod_sku          = $("#prod_sku").val();
    prod_upc          = $("#prod_upc").val();
    prod_name         = $("#prod_name").val();
    prod_desc         = $("#prod_desc").val();
//  prod_qty          = $("#prod_qty").val();
    prod_color        = $("#prod_color").val();
    prod_size         = $("#prod_size").val();
    prod_weight       = $("#prod_weight").val();
    prod_sup_id       = $("#prod_sup_id").val();
    prod_status       = $("#prod_status").val();

    wantedData = {
        prod_id:prod_id,
        prod_cat_id:prod_cat_id,
        prod_sku:prod_sku,
        prod_upc:prod_upc,
        prod_name:prod_name,
        prod_desc:prod_desc,
//      prod_qty:prod_qty,
        prod_color:prod_color,
        prod_size:prod_size,
        prod_weight:prod_weight,
        prod_sup_id:prod_sup_id,
        prod_status:prod_status};
        
    if(prod_cat_id != "" && prod_name != "" && prod_sup_id != ""){
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax.php?func=editProduct",
            data         : wantedData,
            cache        : false,
            dataType     : "json",
            beforeSend   : function () {
                $('#lblMsg').html("");
                $('#loader').show();
            },
            complete: function () {
                $('#loader').hide();
            },
            success      : function(result){
                console.log(result.msg);
                if(result.msg == "1"){
                    $('#lblMsg').html("Supplier has been edited successfuly");
                }
                else{
                    $('#lblMsg').html("Supplier has not been edited.");
                }
                
            }
        });
    }
    else{
        $('#lblMsg').html("Please fill in all required fields");
    }
}
function addSupplier(){
    sup_comp          = $("#sup_comp").val();
    sup_name          = $("#sup_name").val();
    sup_title         = $("#sup_title").val();
    sup_add_1         = $("#sup_add_1").val();
    sup_add_2         = $("#sup_add_2").val();
    sup_city          = $("#sup_city").val();
    sup_cnt_id        = $("#sup_cnt_id").val();
    sup_tel_1         = $("#sup_tel_1").val();
    sup_tel_2         = $("#sup_tel_2").val();
    sup_fax           = $("#sup_fax").val();
    sup_email         = $("#sup_email").val();
    sup_site          = $("#sup_site").val();
    sup_logo          = $("#sup_logo").val();

    wantedData = {sup_comp:sup_comp, sup_name:sup_name, sup_title:sup_title,
                  sup_add_1:sup_add_1, sup_add_2:sup_add_2, sup_city:sup_city,
                  sup_cnt_id:sup_cnt_id, sup_tel_1:sup_tel_1, sup_tel_2:sup_tel_2,
                  sup_fax:sup_fax, sup_email:sup_email, sup_site:sup_site, sup_logo:sup_logo };
        
    if(sup_comp != "" && sup_name != "" && sup_add_1 != ""
       && sup_cnt_id != "" && sup_tel_1 != "" && sup_fax != ""
       && sup_email != "" && sup_site != ""){
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax.php?func=addSupplier",
            data         : wantedData,
            cache        : false,
            dataType     : "json",
            beforeSend   : function () {
                $('#lblMsg').html("");
                $('#loader').show();
            },
            complete: function () {
                $('#loader').hide();
            },
            success      : function(result){
                
                console.log(result.msg);
                if(result.msg == "1"){
                    $('#lblMsg').html("Supplier has been added successfuly");
                }
                else{
                    $('#lblMsg').html("Supplier has not been added.");
                }                
            }
        });
    }
    else{
        $('#lblMsg').html("Please fill in all required fields");
    }
}
function editSupplier(){
    sup_id            = $("#sup_id").val();
    sup_comp          = $("#sup_comp").val();
    sup_name          = $("#sup_name").val();
    sup_title         = $("#sup_title").val();
    sup_add_1         = $("#sup_add_1").val();
    sup_add_2         = $("#sup_add_2").val();
    sup_city          = $("#sup_city").val();
    sup_cnt_id        = $("#sup_cnt_id").val();
    sup_tel_1         = $("#sup_tel_1").val();
    sup_tel_2         = $("#sup_tel_2").val();
    sup_fax           = $("#sup_fax").val();
    sup_email         = $("#sup_email").val();
    sup_site          = $("#sup_site").val();
    sup_logo          = $("#sup_logo").val();

    wantedData = {sup_id:sup_id,sup_comp:sup_comp, sup_name:sup_name, sup_title:sup_title,
                  sup_add_1:sup_add_1, sup_add_2:sup_add_2, sup_city:sup_city,
                  sup_cnt_id:sup_cnt_id, sup_tel_1:sup_tel_1, sup_tel_2:sup_tel_2,
                  sup_fax:sup_fax, sup_email:sup_email, sup_site:sup_site, sup_logo:sup_logo };
        
    if(sup_comp != "" && sup_name != "" && sup_add_1 != ""
       && sup_cnt_id != "" && sup_tel_1 != "" && sup_fax != ""
       && sup_email != "" && sup_site != ""){
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax.php?func=editSupplier",
            data         : wantedData,
            cache        : false,
            dataType     : "json",
            beforeSend   : function () {
                $('#lblMsg').html("");
                $('#loader').show();
            },
            complete: function () {
                $('#loader').hide();
            },
            success      : function(result){
                
                console.log(result.msg);
                if(result.msg == "1"){
                    $('#lblMsg').html("Supplier has been edited successfuly");
                }
                else{
                    $('#lblMsg').html("Supplier has not been edited.");
                }                
            }
        });
    }
    else{
        $('#lblMsg').html("Please fill in all required fields");
    }
}