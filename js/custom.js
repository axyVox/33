$(document).ready(function(){
    var path = window.location.pathname;
    path = path.replace(/\/$/,"");
    path = decodeURIComponent(path);

    $(".nav > li > a").each(function(){
        var href = $(this).attr("href");
        if(path.indexOf(href) > -1){
            $(this).parent("li").addClass("active");
        }
    });
});