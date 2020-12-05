<div class="settings">
	<h4 class="header">Имя услуги</h4>
	<h4 class="second-header">Текущее значение:</h4>
	<form action="/scripts/sender_post.php" class="form-group" method='post'>
		<div><input type="text" value="%service-name%" name="service-name" required></div>
		<div><input type="hidden" value="%service-id%" name="service-id"></div>
		<div><input type="submit" value="Изменить" name="edit-service-name"></div>
	</form>
<br /><br />
	<h4 class="header">Категория</h4>
	<h4 class="second-header">Текущее значение:</h4>
	<form action="/scripts/sender_post.php" class="form-group" method='post'>
		<select name="service-cat" id="cat">
			%options%
		</select>
		<div><input type="hidden" value="%service-id%" name="service-id"></div>
		<div><input type="submit" value="Изменить" name="edit-service-cat"></div>
	</form>
</div>

<div class="settings">
	<h4 class="header">Описание услуги <span class="text-required">( <span class="red">*</span> не больше 100 слов! )</span></h4>
	<h4 class="second-header">Текущее значение:</h4><br />
	<form action="/scripts/sender_post.php" class="form-group" method='post'>
		<div><textarea name="service-desc" id="tiny" required>%list-services%</textarea></div>
		<div><input type="hidden" value="%service-id%" name="service-id"></div>
		<div><input type="submit" value="Изменить" name="edit-service-desc"></div>
	</form>
</div>

<div class="settings">
	<button class="delete">Удалить пост</button>
</div>

<div class="message">
	<h4>Удалить пост?</h4>
	<span class="alias">%service-id%</span>
	<button class="yes">Да</button>
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