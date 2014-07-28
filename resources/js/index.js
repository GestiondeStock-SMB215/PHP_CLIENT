$(document).ready(function(){  
    $('.welcome').click(function () {
        $('.pnlLogin').slideToggle("slide");
    });
    
    $(".title").hover(function () {
        var id = $(this).html();
        $('.sub').slideUp();
        $('#' + id).slideDown();
    }, function () {
        $('.sub').slideUp();
    });
    
    

});
