/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){     
    $("#btnLogin").click(function () {
        login();
    });
    
     $("#btnSubmitMail").click(function () {
        forgot();
    });
    
    $("#btnRegister").click(function () {
        register()();
    });
    
    $("#btnFP").click(function () {
        $("#loginContainer").css("display","none");
        $("#fpContainer").css("display","block");
        $(".subMenu").html("Forgot Password");        
    });
    
    $("#btnBack").click(function () {
        $("#loginContainer").css("display","block");
        $("#fpContainer").css("display","none");
        $(".subMenu").html("Login");  
    });    
});

function register() {
    $("#lblMsg").html("");
    var user_name = $("#user_FN").val() + " " + $("#user_LN").val();
    var user_username = $("#user_username").val();
    var user_email = $("#user_email").val();
    var user_password = $("#user_password").val();
    var user_passwordconf = $("#user_passwordconf").val();
    var registerData = "{'user_name':'" + user_name + "', " + "'user_email':'" + user_email + "', " + "'user_username':'" + user_username + "', " + "'user_password':'" + user_password + "'}";

    if (user_name !== "" && user_name !== " ") {
        if (user_username !== "" && user_username !== " ") {
            if (user_email !== "" && user_email !== " ") {
                if (isValidEmailAddress(user_email) === true) {
                    if (user_password !== "" && user_password !== " ") {
                        if (user_passwordconf !== "" && user_passwordconf !== " ") {
                            if (identicPswd(user_password, user_passwordconf) === true) {
                                $.ajax({
                                    type: "POST",
                                    url: "register.php",
                                    data: registerData,
                                    contentType: "application/json; charset=utf-8",
                                    dataType: "json",
                                    beforeSend: function () {
                                        $("#registerLoader").show();
                                    },
                                    complete: function () {
                                        $("#registerLoader").hide();
                                    },
                                    success: function (data) {
                                        if (data.d === "success") {
                                            $("#lblMsg").html("Registration completed! An email will be sent to you");
                                            setTimeout(function () { window.location.reload(); }, 3000);
                                        }
                                        else
                                            $("#lblMsg").html(data.d);
                                    }
                                });
                            }
                            else {
                                $("#lblMsg").html("Please confirm your password correctly");
                            }
                        }
                        else {
                            $("#lblMsg").html("Please enter all mandatory fields");
                        }
                    }
                    else {
                        $("#lblMsg").html("Please enter all mandatory fields");
                    }
                }
                else {
                    $("#lblMsg").html("Please enter a valid email address");
                }
            }
            else {
                $("#lblMsg").html("Please enter all mandatory fields");
            }
        }
        else {
            $("#lblMsg").html("Please enter all mandatory fields");
        }
    }
    else {
        $("#lblMsg").html("Please enter all mandatory fields");
    }
}

function login() {
    var user_username = $("#txtEmail").val();
    var user_password = $("#txtPswd").val();

    if (user_username !== "" && user_username !== " ") {
        if (user_password !== "" && user_password !== " ") {
            var wantedData = "{'user_username':'" + user_username + "', " + "'user_password':'" + user_password + "'}";
            $.ajax({
                type: "post",
                url: "login.php",
                data: wantedData,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                beforeSend: function () {
                    $('#lblMsgLogin').html("");
                    $('#loginLoader').show();
                },
                complete: function () {
                    $('#loginLoader').hide();
                },
                success: function (data) {
                    if (data.d === "signedIn") {
                        location.reload();
                    }
                    else
                        $('#lblMsgLogin').html(data.d);
                }
            });
        }
        else {
            $('#lblMsgLogin').html("Please enter your password.");
        }
    }
    else {
        $('#lblMsgLogin').html("Please enter your username.");
    }
}

function forgot() {
    if (inprocess === 1) {
        var user_username = $("#txtUsernameFPswd").val();
        if (user_username !== "" && user_username !== " ") {
            if (isValidEmailAddress(user_username) === true) {
                var wantedData = "{'user_username':'" + user_username + "'}";
                $.ajax({
                    type: "post",
                    url: "forgotPassword.php",
                    data: wantedData,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    beforeSend: function () {
                        inprocess = 0;
                        $('#lblForgot').html("");
                        $('#forgotLoader').show();
                        $('#btnSubmitMail').val("OK");
                    },
                    complete: function () {
                        $('#forgotLoader').hide();
                        $('#btnSubmitMail').val("SUBMIT");
                        inprocess = 1;
                    },
                    success: function (data) {
                        $('#lblForgot').html(data.d);
                    }
                });
            }
            else {
                $('#lblForgot').html("Please enter a valid email address.");
            }
        }
        else {
            $('#lblForgot').html("Please enter your email address.");
        }
    }
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

function identicPswd(pswd, confPswd) {
    if (pswd !== confPswd)
        return false;
    else
        return true;
} 