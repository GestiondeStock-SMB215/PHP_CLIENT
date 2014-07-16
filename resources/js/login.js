$(document).ready(function(){
    $("body").css('background-color','#aaa');
    $("#txtUsername").focus();
    $("#btnLogin").click(function () {
        login();
    });
    $("#loginform").keypress(function (event) {
        if(event.which === 13){
            login();
        }
    });
    
});

function login() {
    user_username = $("#txtUsername").val();
    user_password = $("#txtPswd").val();
    if (user_password !== "" && user_password !== "") {
        wantedData = {user_username: user_username ,user_password: user_password };
        $.ajax({
            type         : "POST",
            url          : "/resources/ajax/checkLogin.php",
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