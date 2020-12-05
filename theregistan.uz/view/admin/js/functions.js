

function responsive_filemanager_callback(field_id){
	var url=jQuery('#'+field_id).val();
	$("#"+field_id).attr("src", url);
	$(".img_inner").text(url);
	$("#img_input_hidden").val(url);
}

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

})


$(document).on("click", ".message .no", function(){
$($(this).parent()).fadeOut(150)
})

$(document).on("click", "#post_", function(){

var title = $("input[name='title']").val()
var cover = $("input[name='post_cover']").val()
var category = $("select[name='category']").val()
var full_text = tinyMCE.get("tinyeditor").getContent()

if(title == "" || cover == "" || category == "" || full_text == ""){
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

$(document).on("click", ".save_img", function(){

	var url = $("#img_input_hidden").val();

	$.ajax({

		type: "POST",
		url: "http://theregistan.uz/scripts/sender_post.php",
		data: ({ edit_img: true, url: url }),
		success: function(resp){
			if(resp == "OK") location.reload();
			else if(resp == "ERR") alert("Что-то пошло не так. Повторите попытку");
		}
	});
	return false;
});

})