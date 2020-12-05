<div class="settings">
	<h4 class="header">Изображение <span class="red">*</span></h4>
	<h4 class="second-header">Текущее значение:</h4>
	<form action="/scripts/sender_post.php" class="form-group" method='post'>
		<div class="input-img"><input type="text" id="img_field" value="%client-logo%" name="client-logo" required>
		<div class="find">
			<a href="/filemanager/dialog.php?type=1&field_id=img_field" class="cover_image_btn fancy"></a>
		</div>
		</div>
		<div><input type="hidden" value="%client-id%" name="client-id"></div>
		<div><input type="submit" value="Изменить" name="edit-client-img"></div>
	</form>
</div>

<div class="settings">
	<h4 class="header">Описание <span class="red">*</span></h4>
	<h4 class="second-header">Текущее значение:</h4><br />
	<form action="/scripts/sender_post.php" class="form-group" method='post'>
		<div><textarea name="client-desc" id="tiny" required>%client-desc%</textarea></div>
		<div><input type="hidden" value="%client-id%" name="client-id"></div>
		<div><input type="submit" value="Изменить" name="edit-client-desc"></div>
	</form>
</div>

<div class="settings">
	<button class="delete">Удалить пост</button>
</div>

<div class="message">
	<h4>Удалить пост?</h4>
	<span class="alias">%client-id%</span>
	<button class="yes client">Да</button>
	<button class="no">Нет</button>
</div>

<script type="text/javascript" src="%address%%main_dir%admin/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
  selector:'#tiny',
  height: 300,
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