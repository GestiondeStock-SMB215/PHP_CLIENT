$(document).ready(function(){
    $("#txtUsername").focus();
    $("#txtUsername").blur(function () {
        checkUserNameValidity();
    });
});

//function checkUserNameValidity() {
//    user_username = $("#txtUsername").val();
//    if (user_username !== "") {
//        wantedData = {user_username: user_username};
//        $.ajax({
//            type         : "POST",
//            url          : "/resources/ajax/checkUserNameValidity.php",
//            data         : wantedData,
//            cache        : false,
//            dataType     : "json",
//            success      : function(result){
//                console.log(result.msg);
//                if(result.err == "1"){
//                    $("#txtUsername").val('');
//                    $("#txtUsername").focus();
//                }
//                $('#lblMsg').html(result.msg);
//           }
//        });
//    }
//    else{
//        $('#lblMsgLogin').html("Username and/or Password are required.");        
//    }
//}