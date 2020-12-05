(/*$(function(){

$(window).on("load", function(){

setTimeout(function(){
$(".instagram a").each(function(){
	if($(this).attr("href") === "https://elfsight.com/instagram-feed-instashow/?utm_source=websites&utm_medium=clients&utm_content=instagram-feed&utm_term=undefined&utm_campaign=free-widget") $(this).remove();
});

}, 300);

});
});*/

$(function(){

	$(document).on("click", ".lines", function(){
		var first = $(this).children().get(0);
		var second = $(this).children().get(1);
		var third = $(this).children().get(2);
			$(first).css({
					"-webkit-transform": "translate(1px, 11px) rotate(-45deg)",
					"-ms-transform": "translate(1px, 11px) rotate(-45deg)",
							"transform": "translate(1px, 11px) rotate(-45deg)"
			});
			$(second).css({
				"opacity": 0,
				"transform": "translate(0, 0)"
			});
			$(third).css({
				"-webkit-transform": "translate(1px, -11px) rotate(45deg)",
				"-ms-transform": "translate(1px, -11px) rotate(45deg)",
						"transform": "translate(1px, -11px) rotate(45deg)"
			});
		$(".mobile-menu").stop().slideDown(300).css("display", "block");
		$(this).removeClass("lines").addClass("lines-c");
	});

	$(document).on("click", ".lines-c", function(){
		var first = $(this).children().get(0);
		var second = $(this).children().get(1);
		var third = $(this).children().get(2);
			
			$(first).css({
				"-webkit-transform": "translate(0, 0) rotate(0deg)",
				"-ms-transform": "translate(0, 0) rotate(0deg)",
						"transform": "translate(0, 0) rotate(0deg)",
			});
			$(second).css({
				"opacity": 1,
				"transform": "translate(0, 0)"
			});
			$(third).css({
				"-webkit-transform": "translate(0, 0) rotate(0deg)",
				"-ms-transform": "translate(0, 0) rotate(0deg)",
						"transform": "translate(0, 0) rotate(0deg)"
			});
		$(".mobile-menu").stop().slideUp(300);
		$(this).removeClass("lines-c").addClass("lines");
	});

var window_w = $(window).width();

	if(window_w <= 1060) $(".menu-wrap").removeClass("menu-wrap").addClass("mobile-menu");
	else if(window_w >= 1060) $(".mobile-menu").addClass("menu-wrap").removeClass("mobile-menu");	

$(window).resize(function(){

	window_w = $(this).width();
	if(window_w <= 1060){
		$(".menu-wrap").removeClass("menu-wrap").addClass("mobile-menu");
		$(".mobile-menu").css("display", "none");
}
	else if(window_w >= 1060){
		$(".mobile-menu").addClass("menu-wrap").removeClass("mobile-menu");
		$(".menu-wrap").css("display", "block");
	}

});

}))