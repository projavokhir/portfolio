$(function(){

$(".fancy").fancybox({
'width'		: 900,
'height'	: 600,
'type'		: 'iframe',
'autoScale': false
});

$(document).on("click", ".inner-admin .delete", function(){

var alias = $(this).attr("data")

var mess = $(".message")

$($(mess).find("h4")).text("Удалить пост?")
$($(mess).find(".alias")).text(alias)

$(mess).stop().fadeIn(150)

return false;
})


$(document).on("click", ".message .yes", function(){

var alias = $($($(this).parent()).find(".alias")).text()
var mess = $(this).parent()

$.ajax({
	type: "POST",
	url: "/scripts/sender_post.php",
	data: ({ delete: "delete", alias:alias }),
	success: function(){
		$(mess).fadeOut(150)
		$($(mess).find(".alias")).text("")
		alert("Ваш запрос на обработке! ")
	}
})
setTimeout(function(){
	window.location.reload();
}, 1000);

})


$(document).on("click", ".message .no", function(){
$($(this).parent()).fadeOut(150)
})

$(document).on("click", "#post_", function(){

var pr_name = $("input[name='pr_name']").val()
var images = $("input[name='pr_main_img']").val()
var category = $("select[name='category']").val()
var factors_input = $("input[name='factor-main']").val()
var factors = $("select[name='factor-main']").val()
var description = tinyMCE.get("tinyeditor").getContent()

if(pr_name == "" || images == "" || category == "" || description == "" || factors_input == "" || factors == ""){
	$(".ajax-message").text("Заполните все поля!")
		$(".ajax-message").stop().animate({opacity: 1}, 100, function(){
			$(this).animate({opacity: 0}, 10000)
		});
return false;
	}

return true;
})

$(document).on("click", ".inner-admin", function(){
var bef = $($(this).find(".before"))
$(bef).addClass("return_1")
if($(bef).hasClass("return")){
	$($(this).find(".return")).css("transform", "rotate(90deg)").removeClass("return")
} else {
	$(bef).css("transform", "rotate(-90deg)").addClass("return")
}
var op = $(this).find(".options")
$(op).slideToggle(150)
})

var opt = $(".form-factors .wrapper select option").length-2;

for(var i = 0; i < opt; i++){

	var wrapper = $($(".wrapper").get(0)).clone()
	$(wrapper).find("input").attr("name", "factor-" + (i + 1))
	$(wrapper).find("select").attr("name", "factor_select-" + (i + 1))
	$(".form-factors").append($(wrapper));
}

/*var wrapc = $(".form-factors .wrapper").length;

$(document).on("click", ".add-factors", function(){
	var wrapper = $($(".wrapper").get(wrapc - 1)).clone()
	$(wrapper).find("input").attr("name", "factor-" + (wrapc));
	$(wrapper).find("select").attr("name", "factor-" + (wrapc));
	$(".form-factors").append($(wrapper));
wrapc++;
	return false;
});*/

/*$(document).on("click", "input[name='add_post']", function(){
	var pr_name = $("input[name='pr_name']").val()
	var images = $("input[name='pr_main_img']").val()
	var category = $("select[name='category']").val()
	var factor_main = $("input[name='factor-main']").val()
	var factors = $("select[name='factor-main']").val()
	var description = tinyMCE.get("tinyeditor").getContent()
	var json = "{ ";
	for(var i = 0; i < $(".wrapper").length; i++){
		var input = $($(".wrapper").get(i)).children("input");
				json += '"' + $(input).attr("name") + '" : "' + $(input).val() + '" ,';
	}


	//alert(json);

});*/



})