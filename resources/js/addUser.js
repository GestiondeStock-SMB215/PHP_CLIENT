$(document).ready(function(){
    //getRoles();
    $("#btnRegister").click(function () {
        addUser();
    });
    $("#registerForm").keypress(function (event) {
        if(event.which === 13){
            addUser();
        }
    });
    $("#user_username").blur(function () {
        checkUserNameValidity();
    });
    $("#user_email").blur(function () {
        checkUserEmailValidity();
    });
});

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