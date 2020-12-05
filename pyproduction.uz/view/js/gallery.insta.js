$(function(){

var $g = $(".gallery");

$.ajax({
	url:"inwidget/index.php",
	type: "POST",
	success: function(data){
		$g.html(data);
	}
});

});