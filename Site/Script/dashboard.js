/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function (){
    
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