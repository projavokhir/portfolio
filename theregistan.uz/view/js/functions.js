$(function(){

	$("#mobile-menu-open").hover(function(){
		$($(this).children().get(0)).css("transform", "rotate(-45deg) translate(-7px, 5px)")
		$($(this).children().get(1)).css("transform", "translate(50px)")
		$($(this).children().get(2)).css("transform", "rotate(45deg) translate(-7px, -5px)")
	}, function(){
		$($(this).children().get(0)).css("transform", "rotate(0) translate(0, 0)")
		$($(this).children().get(1)).css("transform", "translate(0)")
		$($(this).children().get(2)).css("transform", "rotate(0) translate(0, 0)")
	})

$(document).on("click", ".noresponse", function(){
	return false;
})

$(document).on("click", ".showmore", function(){
$(".main-blogs .article-main-blogs").css({
"-webkit-animation": "fadein 5s",
"-moz-animation": "fadein 5s",
"-ms-animation": "fadein 5s",
"animation": "fadein 5s"
})
var all = $(".main-blogs .article-main-blog").length
var lim = all + ",3"
$.ajax({
	type: "POST",
	url: "scripts/sender_post.php",
	data: ({ ajaxcont: true, limit: lim }),
	beforeSend: function(){
		$(".showmore").css("opacity", ".6").text("Загрузка...")
	},
	success: function(res){
		setTimeout(function(){
			if(res != "err"){
			$(".showmore").css("opacity", "1").text("больше")
			$(".main-blogs").append($(res))
		}
			else $(".showmore").css("opacity", "1").text("Нет постов!").removeClass("showmore").addClass("noresponse")
		}, 500)
	}
})
})

$(document).on("click", ".showmorecat", function(){
$(".main-blogs .article-main-blogs").css({
"-webkit-animation": "fadein 5s",
"-moz-animation": "fadein 5s",
"-ms-animation": "fadein 5s",
"animation": "fadein 5s"
})
var all = $(".main-blogs .article-main-blog").length
var lim = all + ",3"
var cat = $($(this).parent()).find(".cat").text()
$.ajax({
	type: "POST",
	url: "../../scripts/sender_post.php",
	data: ({ ajaxcont: true, limit: lim, category: cat }),
	beforeSend: function(){
		$(".showmorecat").css("opacity", ".6").text("Загрузка...")
	},
	success: function(res){
		setTimeout(function(){
			if(res != "err"){
			$(".showmorecat").css("opacity", "1").text("больше")
			$(".main-blogs").append($(res))
		}
			else $(".showmorecat").css("opacity", "1").text("Нет постов!").removeClass("showmorecat").addClass("noresponse")
		}, 500)
	}
})
})

})