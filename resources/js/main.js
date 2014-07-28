function getUserByUsername() {
    user_username = $("#txtUsername").val();
    user_password = $("#txtPswd").val();
    if (user_password !== "" && user_password !== "") {
        wantedData = {user_username: user_username ,user_password: user_password };
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax/getUserByUsername.php",
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
            url          : "/resources/ajax/checkUserNameValidity.php",
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
    if (user_email !== "") {
        wantedData = {user_email: user_email};
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax/checkUserEmailValidity.php",
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
                                            url          : "/resources/ajax/addUser.php",
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

function editUser() {
    user_name = $("#user_name").val();
    user_username = $("#user_username").val();
    user_password = $("#user_password").val();
    user_password_conf = $("#user_password_conf").val();
    user_email = $("#user_email").val();
    wantedData = {user_name: user_name,user_username: user_username ,user_password: user_password, 
            user_email: user_email };
        
        if (user_name != "" && user_name != " ") {
            if (user_username != "" && user_username != " ") {
                if (user_email != "" && user_email != " ") {
                    if (isValidEmailAddress(user_email) == true) {
                        if (user_password != "" && user_password != " ") {
                            if (user_password_conf != "" && user_password_conf != " ") {
                                if (identicPswd(user_password, user_password_conf) == true) {
                                    $.ajax({
                                        type         : "POST",
                                        url          : "/resources/ajax/editUser.php",
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
                                                $('#lblMsg').html("User has been updated successfuly");
                                            }
                                            else{
                                                $('#lblMsg').html("User has not been updated. Please try again");
                                            }
                                        }
                                    });
                                    
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
    
}

function addPage(){
    page_parent_id  = $("#page_parent_id").val();
    page_name       = $("#page_name").val();
    page_url        = $("#page_url").val();
    page_acl        = $("#page_acl").val();
    page_in_menu    = $("#page_in_menu").is(":checked");
    if(page_in_menu){page_in_menu = 1;}else{page_in_menu = 0;}
      
    wantedData = {page_parent_id:page_parent_id, page_name:page_name, page_url:page_url, 
            page_acl: page_acl, page_in_menu:page_in_menu};
        
    if(page_name != "" && page_parent_id != "" && page_acl != ""){
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax/addPage.php",
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
    bra_add_srt     = $("#bra_add_srt").val();
    bra_add_1       = $("#bra_add_1").val();
    bra_tel_1       = $("#bra_tel_1").val();
    bra_tel_2       = $("#bra_tel_2").val();
    bra_fax         = $("#bra_fax").val();
    bra_email       = $("#bra_email").val();

    wantedData = {bra_name:bra_name, bra_cnt_id:bra_cnt_id, bra_city:bra_city,
                  bra_add_srt:bra_add_srt, bra_add_1:bra_add_1, bra_tel_1:bra_tel_1,
                  bra_tel_2:bra_tel_2, bra_fax:bra_fax, bra_email:bra_email};
        
    if(bra_name != "" && bra_cnt_id != "" && bra_city != "" && bra_add_1 != "" && bra_tel_1 != ""){
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax/addBranch.php",
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