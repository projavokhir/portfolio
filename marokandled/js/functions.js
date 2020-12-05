$(function(){


$(document).on("click", ".find-button", function(){
	var search = $(this).parent().find(".form-search");
	$(this).hasClass("close") ? "" : $(this).addClass("close");
	$(search).stop().animate({
		width: 180
	}, 150);
});

$(document).on("click", ".find-button.close", function(){
	var search = $(this).parent().find(".form-search");
	$(this).hasClass("close") ? $(this).removeClass("close") : "";
	$(search).stop().animate({
		width: 0
	}, 150);
});


$('.carousel').slick({
	dots: true,
	arrows:true,
	infinite: false
});

$(document).on("click", ".lines-wrap", function(){
var menu  = $(".mobile");
if($(this).hasClass("close") == false){
	$(".lines .line:first-child").css({
		"transform": "rotate(45deg) translate(11px, 10.4px)"
	});

	$($(".lines .line").get(1)).css({
		"margin-left": "100%"
	});

	$(".lines .line:last-child").css({
		"transform": "rotate(-45deg) translate(3.4px, -3.7px)"
	});
	$(this).addClass("close");
	toggleMenu(false, menu);
} else {

	$(".lines .line:first-child").css({
		"transform": "rotate(0deg) translate(0, 0)"
	});

	$($(".lines .line").get(1)).css({
		"margin-left": "0"
	});

	$(".lines .line:last-child").css({
		"transform": "rotate(0deg) translate(0, 0)"
	});
	$(this).removeClass("close");
	toggleMenu(true, menu);
}


});

$(document).on("click", ".mobile ul li a", function(){
	if($(this).parent().hasClass("dd")) $(this).parent().find(".dmenu").stop().slideToggle(300);
	return false;
});

if($(window).width() > 990) $(".mobile").removeClass("mobile").addClass("menu");
else if($(window).width() <= 990) $(".menu").removeClass("menu").addClass("mobile");

$(window).resize(function(){
	if($(this).width() > 990){
		$(".mobile").removeClass("mobile").addClass("menu");
		$(".menu").css({"display": "block", "height": "auto"});
	}
	else if($(this).width() <= 990){
		$(".menu").removeClass("menu").addClass("mobile");
	}
});


$.stellar();

/* pr__desc controller */
resizePR();



$(window).resize(function(){
	resizePR();
});




});

function toggleMenu(b, obj){
	if(b){
		$(obj).slideUp(300);
	} else if(!b){
		$(obj).slideDown(300);
	}
	return false;
}

function resizePR(){
	if($(window).width() > 1200 && $(window).height() >= 700){
	var hpr = $("#ourproducts").outerHeight();
	var top_ = Number($("#ourproducts").css("top").slice(1, -2));
	$("#pr__desc.parall-1").css("margin-top", "-" + (hpr-top_+top_+40) + "px");
} else $("#pr__desc.parall-1").css("margin-top", 0);
}