 $(window).scroll(function(){
    parallax();
})
function parallax(){
    var wScroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    $("#parallax-bg").css("background-position", 'center '+(wScroll*0.5)+'px');
    $("#parallax-bg1").css("background-position", 'center '+(wScroll*0.5 + windowHeight/2.91)+'px');
}
