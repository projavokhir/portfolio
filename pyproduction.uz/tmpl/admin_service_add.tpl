<form action="/scripts/sender_post.php" class="form-group" method='post'>
<div class="settings">
	<h4 class="header">Имя услуги</h4>
	<h4 class="second-header">Текущее значение:</h4>
		<div><input type="text" name="service-name" required></div>
<br /><br />
	<h4 class="header">Категория</h4>
	<h4 class="second-header">Текущее значение:</h4>
		<select name="service-cat" id="cat">
			<option value=""></option>
			%options%
		</select>
</div>

<div class="settings">
	<h4 class="header">Описание услуги <span class="text-required">( <span class="red">*</span> не больше 100 слов! )</span></h4>
	<h4 class="second-header">Текущее значение:</h4><br />
		<div><textarea name="service-desc" id="tiny"></textarea></div>
		<div><input type="submit" value="Добавить" name="add-service"></div>
</div>
</form>

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