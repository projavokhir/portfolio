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
		<input type="hidden" value="%alias%" name="alias" />
		<div class="form-wr">
			<label for="tt">Имя продукта <span class="req">*</span></label><br />
			<input type="text" name="pr_name" id="tt" value="%pr_name%" />
		</div>
	<div class="form-wr">
			<label for="img_c_main">Изображение продукта:<span class="req">*</span></label><br />
			<div class="inner">
				<input type="text" name="pr_main_img" id="img_c_main" value="%img_c_main%" />
				<div class="find"> 
					<a href="/filemanager/dialog.php?type=1&field_id=img_c_main" class="cover_image_btn fancy"></a>
					</div>
			</div>
	</div>
	<div class="form-wr">
			<label for="img_c_1">Дополнительное изображение (необъязательно)</label><br />
			<div class="inner">
				<input type="text" name="pr_img_1" id="img_c_1" value="%img_c_1%" />
				<div class="find"> 
					<a href="/filemanager/dialog.php?type=1&field_id=img_c_1" class="cover_image_btn fancy"></a>
					</div>
			</div>
	</div>
	<div class="form-wr">
			<label for="img_c_2">Дополнительное изображение (необъязательно)</label><br />
			<div class="inner">
				<input type="text" name="pr_img_2" id="img_c_2" value="%img_c_2%" />
				<div class="find"> 
					<a href="/filemanager/dialog.php?type=1&field_id=img_c_2" class="cover_image_btn fancy"></a>
					</div>
			</div>
	</div>
	
	<div class="factors-wrapper">
		
	</div>
	
	<div class="form-wr">
			<label>Категория <span class="req">*</span></label><br />
			<select name="category" id="product-cat" size="1">
				<option value=""></option>
				%categories%
			</select>
		</div>

		<div class="form-wr">
			<label>Цена <span class="req">*</span></label><br />
				<input type="number" name="price" value="%price%" />
	</div>

	<div class="form-factors">
			<label>Факторы продукта <span class="req">*</span></label><br /><br />
				<div class="wrapper">
					<select name="factor_main-select" id="product-factors" size="1" >
						<option value=""></option>
						%factors%
					</select>
					<input type="text" name="factor_main" class="factor-1" placeholder="Значение 1" autocomplete="off">
				</div>
		</div>

		<div id="tiny-wr">
			<label for="tinyeditor">Полное описание <span class="req">*</span></label><br /><br />
			<textarea name="full_text" id="tinyeditor">%description%</textarea>
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
      "advlist autolink lists charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern imagetools" 
  ],
  language: 'ru',
  toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
  toolbar2: "preview | forecolor backcolor emoticons | responsivefilemanager",
});
</script>