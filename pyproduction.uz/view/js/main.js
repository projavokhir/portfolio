let vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty('--vh', `${vh}px`);
$(document).ready(function(){
$(window).load(function(){
setTimeout(function(){$(".loader").fadeOut(900);}, 1000);
});

$(".menu-logo-lines, .sidebar-top__close").on("click", function() {
$('html').toggleClass("open-sidebar");
});

$('.section.flexbox-s-a').append($('.footer-wrap'));

$(document).click(function(e) {
var bar = $(".sidebar");
var btn = $(".menu-logo-lines");
if ((e.target != bar[0] && !bar.has(e.target).length) && (e.target != btn[0] && !btn.has(e.target).length)) {
$('html').removeClass("open-sidebar");
}
});

var $sc = $(".fp-items-scroller li a")

var height = $('section.main-page').height();
$(window).resize(function(){
 height = $('section.main-page').height();
})

if($(window).width() < 800){
 $(".main-page").on("click", ".scroll-tbt", function(){
  $('html, body').animate({scrollTop:height}, 600);
 });
}

$sc.on("click", function(){
    var anch = $(this).attr("data-index");
    fullpage_api.moveTo(anch);
    $sc.removeClass("active");
    $(this).addClass("active");
    return false;
});

var d = new Date();
$(".year").text(d.getFullYear());

$(".center_menu").on("click", ".footer-menu .menu-header", function(){
var $ul = $(".footer-menu ul");
if($(window).width() <= 991){
    $ul.stop().slideUp();
    $(this).parent().find("ul").stop().slideToggle();
    if(!$(this).find(".arr").hasClass("rotate")){
        $(".footer-menu .menu-header .arr").removeClass("rotate");
        $(this).find(".arr").addClass("rotate");
    } else {
        $(this).find(".arr").removeClass("rotate");
    }
}
});


window.onload = function(){
for(var i = 0; i < $('.clients-list li').length; i++){

$($('.clients-list li').get(i)).baron({
root: '.clients-list',
scroller: '.wrp-t.cl-scroller',
bar: '._bar'
}).autoUpdate();
} 
 };

$('.vacs div').on('click', 'a', function(){
    var href = $(this).attr('href').slice(1, $(this).attr('href').length);
     if(typeof $('#'+href).html() === 'undefined') return;
        $('html,body').css({'overflow':'hidden','padding-right':'8px'})
        $('.overlay-container').css({'overflow-y':'scroll', 'opacity':1, 'display':'block'})
        $('.overlay-container .overlay-black').show().animate({opacity:1}, 100, function(){
         $('#'+href).show().animate({'top':'10vh', 'opacity':1}, 350);
        })
    return false
});

$('.detailes').on('click', '.close-window', function(){
    var $o = $(this).parent();
    $('.overlay-container').css('overflow-y','hidden')
    $('html,body').css({'overflow':'auto','padding-right':0})
    $($o).animate({top:'6vh', opacity:0}, 400, function(){
        $('.overlay-container .overlay-black').animate({opacity:0}, 100, function(){
         $(this).hide();
         $($(this).parent()).hide();
        })
    });
    return false
});

var $cl = $('.clients-block .clients-list li'),w_cl;

resizeCL();

$(window).resize(resizeCL);

function resizeCL(){
w_cl = $cl.width();
$cl.css({'height':w_cl});    
}

});  //the end of the ready function


$(function(){
$(".show-on-map").on("click", function(){
var city = $(this).attr("data-city");
if(city == "узб"){
myMap.setCenter([39.660120, 66.939834], 18, {
checkZoomRange: true
});
} else if(city == "россия"){
myMap.setCenter([59.851671, 30.268076], 18, {
checkZoomRange: true
});
}$("html,body").animate({scrollTop:$('.map').offset().top},600);});});
$(function(){
resize();
$(window).resize(resize);
});
function resize(){
var $o=$('.services .service-block.front-page'),
h = $o.width()/1.4780058651;
$o.height(h);
}