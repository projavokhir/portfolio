<h2 class="main-header">%page_head%</h2>
	<nav class="navbar">
		<ul>
			<li><a href="/admin/add-post">Добавить пост</a></li>
			<li><a href="/admin/posts">Посты</a></li>
			<li><a href="/admin/slider">Слайдер</a></li>
		</ul>
	</nav>
<div class="add-post">
<br /><div class="php-message">%message%</div><br />
	<form action="/scripts/sender_post.php" method="POST" id="post-add-form" enctype="multipart/form-data">
			<input type="hidden" name="alias" value="%alias%" autocomplete="off" />
		<div class="form-wr">
			<label for="tt">Заголовок <span class="req">*</span></label><br />
			<input type="text" name="title" id="tt" value="%title%" autocomplete="off" />
		</div>
	<div class="form-wr">
			<label for="img_c">Изображение для обложки поста <span class="req">*</span></label><br />
			<div class="inner">
				<input type="text" name="post_cover" id="img_c" value="%img_c%" autocomplete="off" />
				<div class="find"> 
					<a href="/filemanager/dialog.php?type=1&field_id=img_c" class="cover_image_btn fancy"></a>
					</div>
			</div>
	</div>
	<div class="form-wr">
			<label for="img_c">Описание поста <span class="req">*</span></label><br />
				<input type="text" name="desc" value="%desc%" autocomplete="off" />
	</div>
	<div class="form-wr">
			<label for="img_c">Ключевые слова <span class="req">*</span></label><br />
				<input type="text" name="keywords" value="%keywords%" autocomplete="off" />
	</div>
	<div class="form-wr">
			<label>Категория <span class="req">*</span></label><br />
			<select name="category" id="post-category" size="1" >
				<option value=""></option>
				%option%
			</select>
		</div>
		<div id="tiny-wr">
			<label for="tinyeditor">Полный текст <span class="req">*</span></label><br /><br />
			<textarea name="full_text" id="tinyeditor">%full_text%</textarea>
		</div>
		<div id="submit-wr">
			<span class="ajax-message">Message</span><br />
			<input type="submit" value="Отправить" id="post_" name="%submit_name%">
		</div>
	</form>
</div>
<script type="text/javascript" src="%address%%main_dir%admin/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
  selector:'#tinyeditor',
  height: 400,
  width: "auto",
  plugins: [
      "advlist autolink lists image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern imagetools" 
  ],
  language: 'ru',
  toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
  toolbar2: "preview media | forecolor backcolor emoticons | responsivefilemanager",
 external_filemanager_path:"../../filemanager/",
 filemanager_title:"Responsive Filemanager" ,
 external_plugins: { "filemanager" : "%address%filemanager/plugin.min.js"},
 relative_urls: false,
 remove_script_host: true,
 document_base_url: "http://pymag.uz/"
});
</script>