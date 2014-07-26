$(document).ready(function(){
    $("#btnRegister").click(function () {
        register();
    });
       
});

//function register() {
//    user_name = $("#txtName").val();
//    user_email = $("#txtEmail").val();
//    user_username = $("#txtUsername").val();
//    user_password = $("#txtPswd").val();
//    conf = $("#txtConf").val();
//    if (user_password !== "" && user_password !== "") {
//        wantedData = {user_name: user_name ,user_username: user_username ,user_email: user_email ,user_password: user_password };
//        $.ajax({
//            type         : "POST",
//            url          : "/resources/ajax/add.php",
//            data         : wantedData,
//            cache        : false,
//            dataType     : "json",
//            beforeSend   : function () {
//                $('#lblMsg').html("");
//                $('#loader').show();
//            },
//            complete: function () {
//                $('#loader').hide();
//            },
//            success      : function(result){
//                console.log(result.msg);
//                $('#lblMsg').html(result.msg);
//            }
//        });
//    }
//    else{
//        $('#lblMsg').html("Username and/or Password are required.");        
//    }
//}