<h2 class="main-header">%page_head%</h2>
	<nav class="navbar">
		<ul>
			<li><a href="/admin/add-post">Добавить продукт</a></li>
			<li><a href="/admin/blocks">Блоки сайта</a></li>
			<li><a href="/admin/posts">Продукты</a></li>
		</ul>
	</nav>
<div class="add-post">
	<br /><div class="php-message">%message%</div><br />
	<form action="/scripts/sender_post.php" method="POST" id="post-add-form">
		<input type="hidden" value="%id%" name="id" />
		<div class="form-wr">
			<label for="tt">Заголовок <span class="req">*</span></label><br />
			<input type="text" name="header" id="tt" value="%header%" />
		</div>
		<div class="form-wr">
			<label for="tt">Подзаголовок <span class="req">*</span></label><br />
			<input type="text" name="desc" id="tt" value="%desc%" />
		</div>
		<div id="submit-wr">
			<input type="submit" value="Изменить" id="post_" name="edit_products_d">
		</div>
	</form>
</div>

<div class="message">
	<h4>Удалить пост?</h4>
	<span class="alias">%id%</span>
	<button class="yes gitem">Да</button>
	<button class="no">Нет</button>
</div>

<script type="text/javascript" src="%address%%main_dir%admin/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
  selector:'#tinyeditor',
  height: 400,
  width: "auto",
  plugins: [
      "advlist autolink lists charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern imagetools" 
  ],
  language: 'ru',
  toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
  toolbar2: "preview | forecolor backcolor emoticons | responsivefilemanager",
});

function responsive_filemanager_callback(field_id){
	var v = $('#'+field_id).val();
	$('.img-block img').attr('src', v)
}

$(document).on('click', '.delete', function(){
	$('.message').fadeIn(400);
	return false
})

$(document).on("click", ".message .yes.gitem", function(){
var id = $($($(this).parent()).find(".alias")).text()
var mess = $(this).parent()
$.ajax({
	type: "POST",
	url: "/scripts/sender_post.php",
	data: ({ delete_g_item: "delete", id:id }),
	success: function(d){
		$(mess).fadeOut(150)
		$($(mess).find(".alias")).text("")
	}
})
setTimeout(function(){
	window.location.reload();
}, 1000);

})

</script>