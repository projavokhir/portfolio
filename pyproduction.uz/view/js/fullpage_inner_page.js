$(function(){

var order;
var $sc = $(".fp-items-scroller li a")

new fullpage('#container-swap', {
    scrollHorizontally:false,
    responsiveWidth:800,
    verticalCentered:false,
    navigation:false,
    onLeave: function(ori, dest, dir){
        var wowEff = $(dest.item).find(".wow"); 
        $(wowEff).each(function(){
            if(!$(this).hasClass("animated")){
                $(this).css({
                    "visibility": "visible",
                    "animation-name": $(this).attr("data-anim")
                }).addClass("animated");
            } else return;
        });
        order = dest.index;
        $("a.active").removeClass("active");
        $($sc.get(order)).addClass("active");
    },
    afterResponsive: function(res){
        const height = $(".section").height();
        if(res) 
            for(var i = 0; i < $(".section").length; i++){
                $($(".section").get(i)).removeAttr("style");
            }
        else 
            for(var i = 0; i < $(".section").length; i++){
                $($(".section").get(i)).css("height", height+"px");
            }
    }
});
});