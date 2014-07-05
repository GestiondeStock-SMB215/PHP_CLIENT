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

function login() {
    var user_username = $("#txtEmail").val();
    var user_password = $("#txtPswd").val();

    if (user_username !== "" && user_username !== " ") {
        if (isValidEmailAddress(user_username) === true) {
            if (user_password !== "" && user_password !== " ") {
                var wantedData = "{'user_username':'" + user_username + "', " + "'user_password':'" + user_password + "'}";
                $.ajax({
                    type: "post",
                    url: url + "default.aspx/login",
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
                            $('#lblMsgLogin').html("Invalid email or password");
                    }
                });
            }
            else {
                $('#lblMsgLogin').html("Please enter your password.");
            }
        }
        else {
            $('#lblMsgLogin').html("Please enter a valid email address.");
        }
    }
    else {
        $('#lblMsgLogin').html("Please enter your email address.");
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
                    url: url + "default.aspx/forgotPassword",
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