/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){     
    $("#btnLogin").click(function () {
        login();
    });
});

function login() {
    var user_username = $("#txtEmail").val();
    var user_password = $("#txtPswd").val();

    if (user_username !== "" && user_username !== " ") {
        if (user_password !== "" && user_password !== " ") {
            var wantedData = {user_username: user_username ,user_password: user_password };
            $.ajax({
                type: "POST",
                url: "/resources/ajax.php?action=login",
                data: wantedData,
                dataType: "json",
                beforeSend: function () {
                    $('#lblMsgLogin').html("");
                    $('#loginLoader').show();
                },
                complete: function () {
                    $('#loginLoader').hide();
                },
                success: function (data) {
                    console.log(data.d);
                    if (data.d === "signedIn") {
                        window.location.href = "index.php";
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

